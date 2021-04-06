package pl.banhangtichluy.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.stereotype.Service;
import pl.banhangtichluy.dto.criteria.BaseCriteriaDto;
import pl.banhangtichluy.dto.criteria.FilterResource;
import pl.banhangtichluy.entity.Amount;
import pl.banhangtichluy.reponsitory.AmountRepository;

import java.util.List;

@Service
public class AmmountService {

    @Autowired
    AmountRepository amountRepository;

    public Page<Amount> list(BaseCriteriaDto criteria) {
        String[] fields = new String[]{"type", "code", "value", "firstName", "lastName", "email", "phone", "note", "createdAt", "updatedAt"};
        List<FilterResource> filters = criteria.getListFilterResource();
        if (filters == null || filters.size() == 0) {
            return amountRepository.findAll(PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
        } else {
            FilterResource fr = filters.get(0);
            switch (fr.getField()) {
                case "type":
                    return amountRepository.findByTypeContaining(fr.getValue(), PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                case "code":
                    return amountRepository.findByCodeContaining(fr.getValue(), PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                case "value":
                    return amountRepository.findByValue(Integer.parseInt(fr.getValue()), PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                case "firstName":
                    return amountRepository.findByFirstNameContaining(fr.getValue(), PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                case "lastName":
                    return amountRepository.findByLastNameContaining(fr.getValue(), PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                case "email":
                    return amountRepository.findByEmailContaining(fr.getValue(), PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                case "phone":
                    return amountRepository.findByPhoneContaining(fr.getValue(), PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                case "note":
                    return amountRepository.findByNoteContaining(fr.getValue(), PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                default:
                    return amountRepository.findAll(PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
            }
        }
    }

    public Amount create(Amount amount) {
        return amountRepository.save(amount);
    }
}
