package pl.banhangtichluy.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.jpa.domain.Specification;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.dto.AmountDto;
import pl.banhangtichluy.dto.criteria.BaseCriteriaDto;
import pl.banhangtichluy.dto.criteria.FilterResource;
import pl.banhangtichluy.dto.views.AmountView;
import pl.banhangtichluy.dto.views.TransactionView;
import pl.banhangtichluy.entity.*;
import pl.banhangtichluy.enums.AmountType;
import pl.banhangtichluy.reponsitory.AmountRepository;
import pl.banhangtichluy.reponsitory.TransactionRepository;
import pl.banhangtichluy.utils.ClassUtils;

import javax.persistence.metamodel.SingularAttribute;
import java.util.List;
import java.util.Optional;

@Service
public class TransactionService {

    @Autowired
    TransactionRepository transactionRepository;

    private final Class VIEW = TransactionView.class;

    public Page<TransactionView> list(BaseCriteriaDto criteria) {
        List<String> fields = ClassUtils.getFieldNameOfClassHasType(Transaction_.class, SingularAttribute.class);
        String createdBy_usernameField = Transaction_.CREATED_BY + "." + User_.USERNAME;
        String createdBy_firstNameField = Transaction_.CREATED_BY + "." + User_.FIRST_NAME;
        String createdBy_lastNameField = Transaction_.CREATED_BY + "." + User_.LAST_NAME;
        fields.add(createdBy_usernameField);
        fields.add(createdBy_firstNameField);
        fields.add(createdBy_lastNameField);
        String updatedBy_usernameField = Transaction_.UPDATED_BY + "." + User_.USERNAME;
        String updatedBy_firstNameField = Transaction_.UPDATED_BY + "." + User_.FIRST_NAME;
        String updatedBy_lastNameField = Transaction_.UPDATED_BY + "." + User_.LAST_NAME;
        fields.add(updatedBy_usernameField);
        fields.add(updatedBy_firstNameField);
        fields.add(updatedBy_lastNameField);
        fields.add(Transaction_.createdBy + "." + User_.firstName);
        fields.add(Transaction_.createdBy + "." + User_.lastName);
        List<FilterResource> filters = criteria.getListFilterResource();
        if (filters.size() > 0) {
            FilterResource fr = filters.get(0);
            String field = fr.getField();
            String value = fr.getValue();
            if (fields.contains(field)) {
                Specification condition = null;
                switch (field) {
                    case Transaction_.CODE:
                        return transactionRepository.findByCodeContaining(value, VIEW, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                    case Transaction_.BEFORE_VALUE:
                        return transactionRepository.findByBeforeValueEquals(Integer.parseInt(value), VIEW, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                    case Transaction_.PLUS_VALUE:
                        return transactionRepository.findByPlusValueEquals(Integer.parseInt(value), VIEW, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                    case Transaction_.AFTER_VALUE:
                        return transactionRepository.findByAfterValueEquals(Integer.parseInt(value), VIEW, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                    case Transaction_.NOTE:
                        return transactionRepository.findByNoteContaining(value, VIEW, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                }
            }
        }
        return transactionRepository.findBy(VIEW, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
    }

    public Optional<TransactionView> detailById(Long id) {
        return transactionRepository.findById(id, VIEW);
    }

    public Optional<TransactionView> detailByCode(String code) {
        return transactionRepository.findByCodeEquals(code, VIEW);
    }
}
