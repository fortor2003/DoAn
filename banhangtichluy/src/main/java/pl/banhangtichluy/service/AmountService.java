package pl.banhangtichluy.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.jpa.domain.Specification;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.dto.AddValueAmountDto;
import pl.banhangtichluy.dto.AmountDto;
import pl.banhangtichluy.dto.criteria.BaseCriteriaDto;
import pl.banhangtichluy.dto.criteria.FilterResource;
import pl.banhangtichluy.dto.views.AmountView;
import pl.banhangtichluy.entity.*;
import pl.banhangtichluy.enums.AmountType;
import pl.banhangtichluy.reponsitory.AmountRepository;
import pl.banhangtichluy.reponsitory.TransactionRepository;
import pl.banhangtichluy.specifications.AmountSpec;
import pl.banhangtichluy.utils.ClassUtils;
import pl.banhangtichluy.utils.WebUtils;

import javax.persistence.metamodel.SingularAttribute;
import java.util.List;
import java.util.Optional;

@Service
public class AmountService {

    @Autowired
    AmountRepository amountRepository;
    @Autowired
    TransactionRepository transactionRepository;

    public Page<AmountView> list(BaseCriteriaDto criteria) {
        Class view = AmountView.class;
        List<String> fields = ClassUtils.getFieldNameOfClassHasType(Amount_.class, SingularAttribute.class);
        String createdBy_usernameField = Amount_.CREATED_BY + "." + User_.USERNAME;
        String createdBy_firstNameField = Amount_.CREATED_BY + "." + User_.FIRST_NAME;
        String createdBy_lastNameField = Amount_.CREATED_BY + "." + User_.LAST_NAME;
        fields.add(createdBy_usernameField);
        fields.add(createdBy_firstNameField);
        fields.add(createdBy_lastNameField);
        String updatedBy_usernameField = Amount_.UPDATED_BY + "." + User_.USERNAME;
        String updatedBy_firstNameField = Amount_.UPDATED_BY + "." + User_.FIRST_NAME;
        String updatedBy_lastNameField = Amount_.UPDATED_BY + "." + User_.LAST_NAME;
        fields.add(updatedBy_usernameField);
        fields.add(updatedBy_firstNameField);
        fields.add(updatedBy_lastNameField);
        fields.add(Amount_.createdBy + "." + User_.firstName);
        fields.add(Amount_.createdBy + "." + User_.lastName);
        List<FilterResource> filters = criteria.getListFilterResource();
        if (filters.size() > 0) {
            FilterResource fr = filters.get(0);
            String field = fr.getField();
            String value = fr.getValue();
            if (fields.contains(field)) {
                Specification condition = null;
                switch (field) {
                    case Amount_.TYPE:
                        return amountRepository.findByTypeEquals(value.toUpperCase().equals(AmountType.GIFT.name().toUpperCase()) ? AmountType.GIFT.name() : AmountType.POINT.name(), view, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                    case Amount_.CODE:
                        return amountRepository.findByCodeContaining(value, view, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                    case Amount_.VALUE:
                        return amountRepository.findByValueEquals(Integer.parseInt(value), view, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                    case Amount_.FIRST_NAME:
                        return amountRepository.findByFirstNameContaining(value, view, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                    case Amount_.LAST_NAME:
                        return amountRepository.findByLastNameContaining(value, view, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                    case Amount_.EMAIL:
                        return amountRepository.findByEmailContaining(value, view, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                    case Amount_.PHONE:
                        return amountRepository.findByPhoneContaining(value, view, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                    case Amount_.NOTE:
                        return amountRepository.findByNoteContaining(value, view, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                }
            }
        }
        return amountRepository.findBy(view, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
    }

    public Optional<AmountView> detailById(Long id) {
        return amountRepository.findById(id, AmountView.class);
    }

    public Optional<AmountView> detailByTypeAndCode(String type, String code) {
        return amountRepository.findByTypeEqualsAndCodeEquals(type.toUpperCase().equals(AmountType.GIFT.name().toUpperCase()) ? AmountType.GIFT.name() : AmountType.POINT.name(), code, AmountView.class);
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
