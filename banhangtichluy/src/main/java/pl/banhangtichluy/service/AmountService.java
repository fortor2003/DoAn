package pl.banhangtichluy.service;

import com.querydsl.core.types.OrderSpecifier;
import com.querydsl.core.types.dsl.PathBuilder;
import com.querydsl.jpa.JPQLQuery;
import com.querydsl.jpa.impl.JPAQueryFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.constants.QuerydslConstant;
import pl.banhangtichluy.dto.request.AddValueAmountDto;
import pl.banhangtichluy.dto.request.AmountDto;
import pl.banhangtichluy.dto.criteria.BaseCriteriaDto;
import pl.banhangtichluy.dto.views.AmountView;
import pl.banhangtichluy.entity.*;
import pl.banhangtichluy.reponsitory.AmountRepository;
import pl.banhangtichluy.reponsitory.TransactionRepository;
import pl.banhangtichluy.utils.FilterCriteriaUtils;
import pl.banhangtichluy.utils.SortCriteriaUtils;
import pl.banhangtichluy.utils.WebUtils;

import java.util.Optional;

@Service
public class AmountService {

    @Autowired
    JPAQueryFactory query;
    @Autowired
    AmountRepository amountRepository;
    @Autowired
    TransactionRepository transactionRepository;

    private final QAmount qAmount = QAmount.amount;

    public Page<AmountView> list(BaseCriteriaDto criteria) {
        PathBuilder<Amount> pathBuilder = new PathBuilder<Amount>(Amount.class, qAmount.getMetadata().getName(), QuerydslConstant.PATH_BUILDER_VALIDATOR);
        JPQLQuery<AmountView> jpql = query
                .from(qAmount)
                .leftJoin(qAmount.createdBy, QUser.user)
                .leftJoin(qAmount.updatedBy, QUser.user)
                .where(FilterCriteriaUtils.getPredicates(pathBuilder, criteria.getFilter()))
                .select(AmountView.PROJECTIONS)
                .orderBy(SortCriteriaUtils.getOrderSpecifiers(pathBuilder, criteria.getSort()).toArray(new OrderSpecifier[0]));
        return amountRepository.findAll(jpql, PageRequest.of(criteria.getPage(), criteria.getSize()));
    }

    public Optional<AmountView> detailById(Long id) {
        JPQLQuery<AmountView> jpql = query
                .from(qAmount)
                .leftJoin(qAmount.createdBy, QUser.user)
                .leftJoin(qAmount.updatedBy, QUser.user)
                .where(qAmount.id.eq(id))
                .select(AmountView.PROJECTIONS);
        return amountRepository.findOne(jpql);
    }

    public Optional<AmountView> detailByTypeAndCode(String type, String code) {
        JPQLQuery<AmountView> jpql = query
                .from(qAmount)
                .leftJoin(qAmount.createdBy, QUser.user)
                .leftJoin(qAmount.updatedBy, QUser.user)
                .where(qAmount.type.eq(type).and(qAmount.code.eq(code)))
                .select(AmountView.PROJECTIONS);
        return amountRepository.findOne(jpql);
    }

    public Optional<AmountView> create(AmountDto amountDto, User createdBy) {
        if (amountRepository.countByTypeAndCode(amountDto.getType(), amountDto.getCode()) > 0) {
            throw new ResponseStatusException(HttpStatus.INTERNAL_SERVER_ERROR, "Type and code of amount already exists");
        }
        Amount amount = new Amount();
        amount.setType(amountDto.getType());
        amount.setCode(amountDto.getCode());
        amount.setValue(amountDto.getValue());
        amount.setFirstName(amountDto.getFirstName());
        amount.setLastName(amountDto.getLastName());
        amount.setEmail(amountDto.getEmail());
        amount.setPhone(amountDto.getPhone());
        amount.setNote(amountDto.getNote());
        amount.setCreatedBy(createdBy);
        Long id = amountRepository.save(amount).getId();
        return detailById(id);
    }

    public Optional<AmountView> update(Long id, AmountDto amountDto, User updatedBy) {
        if (amountRepository.countByTypeAndCodeExceptId(amountDto.getType(), amountDto.getCode(), id) > 0) {
            throw new ResponseStatusException(HttpStatus.INTERNAL_SERVER_ERROR, "Type and code of amount already exists");
        }
        Amount amount = amountRepository.findById(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
        amount.setType(amountDto.getType());
        amount.setCode(amountDto.getCode());
        amount.setValue(amountDto.getValue());
        amount.setFirstName(amountDto.getFirstName());
        amount.setLastName(amountDto.getLastName());
        amount.setEmail(amountDto.getEmail());
        amount.setPhone(amountDto.getPhone());
        amount.setNote(amountDto.getNote());
        amount.setUpdatedBy(updatedBy);
        amountRepository.save(amount);
        return detailById(id);
    }

    public boolean delete(Long id) {
        Amount amount = amountRepository.findById(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
        amountRepository.delete(amount);
        return true;
    }

    @Transactional(rollbackFor = {Exception.class})
    public Optional<AmountView> addValue(Long id, AddValueAmountDto addValueAmountDto, User manipulatedBy) {
        Amount amount = amountRepository.findById(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
        Integer beforeValue = amount.getValue();
        Integer plusValue = addValueAmountDto.getValue();
        Integer afterValue = beforeValue + plusValue;
        if (afterValue < 0) {
            throw new ResponseStatusException(HttpStatus.INTERNAL_SERVER_ERROR, "Current value of amount is not enough");
        }
        Transaction transaction = new Transaction();
        transaction.setBeforeValue(beforeValue);
        transaction.setPlusValue(plusValue);
        transaction.setAfterValue(afterValue);
        transaction.setNote(addValueAmountDto.getNote());
        transaction.setAmount(amount);
        transaction.setCreatedBy(manipulatedBy);
        Long transactionId = transactionRepository.save(transaction).getId();
        transaction.setCode(WebUtils.genCodeTransactionById(transactionId));
        amount.setValue(afterValue);
        amount.setUpdatedBy(manipulatedBy);
        amountRepository.save(amount);
        return detailById(id);
    }
}
