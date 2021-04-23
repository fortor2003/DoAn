package pl.banhangtichluy.service;

import com.querydsl.core.types.OrderSpecifier;
import com.querydsl.core.types.dsl.PathBuilder;
import com.querydsl.jpa.JPQLQuery;
import com.querydsl.jpa.impl.JPAQueryFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.stereotype.Service;
import pl.banhangtichluy.constants.QuerydslConstant;
import pl.banhangtichluy.dto.criteria.BaseCriteriaDto;
import pl.banhangtichluy.dto.views.v2.TransactionView;
import pl.banhangtichluy.entity.QAmount;
import pl.banhangtichluy.entity.QTransaction;
import pl.banhangtichluy.entity.QUser;
import pl.banhangtichluy.entity.Transaction;
import pl.banhangtichluy.reponsitory.TransactionRepository;
import pl.banhangtichluy.utils.FilterCriteriaUtils;
import pl.banhangtichluy.utils.SortCriteriaUtils;

import java.util.Optional;

@Service
public class TransactionService {

    @Autowired
    JPAQueryFactory query;
    @Autowired
    TransactionRepository transactionRepository;

    private final QTransaction qTransaction = QTransaction.transaction;

    public Page<TransactionView> list(BaseCriteriaDto criteria) {
        PathBuilder<Transaction> pathBuilder = new PathBuilder<Transaction>(Transaction.class, qTransaction.getMetadata().getName(), QuerydslConstant.PATH_BUILDER_VALIDATOR);
        JPQLQuery<TransactionView> jpql = query
                .from(qTransaction)
                .leftJoin(qTransaction.amount, QAmount.amount)
                .leftJoin(qTransaction.createdBy, QUser.user)
                .leftJoin(qTransaction.updatedBy, QUser.user)
                .where(FilterCriteriaUtils.getPredicates(pathBuilder, criteria.getFilter()))
                .select(TransactionView.PROJECTIONS)
                .orderBy(SortCriteriaUtils.getOrderSpecifiers(pathBuilder, criteria.getSort()).toArray(new OrderSpecifier[0]));
        return transactionRepository.findAll(jpql, PageRequest.of(criteria.getPage(), criteria.getSize()));
    }

    public Optional<TransactionView> detailById(Long id) {
        JPQLQuery<TransactionView> jpql = query
                .from(qTransaction)
                .leftJoin(qTransaction.amount, QAmount.amount)
                .leftJoin(qTransaction.createdBy, QUser.user)
                .leftJoin(qTransaction.updatedBy, QUser.user)
                .where(qTransaction.id.eq(id))
                .select(TransactionView.PROJECTIONS);
        return transactionRepository.findOne(jpql);
    }

    public Optional<TransactionView> detailByCode(String code) {
        JPQLQuery<TransactionView> jpql = query
                .from(qTransaction)
                .leftJoin(qTransaction.amount, QAmount.amount)
                .leftJoin(qTransaction.createdBy, QUser.user)
                .leftJoin(qTransaction.updatedBy, QUser.user)
                .where(qTransaction.code.eq(code))
                .select(TransactionView.PROJECTIONS);
        return transactionRepository.findOne(jpql);
    }
}
