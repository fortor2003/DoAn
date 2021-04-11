package pl.banhangtichluy.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.jpa.domain.Specification;
import org.springframework.http.HttpStatus;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.dto.*;
import pl.banhangtichluy.dto.criteria.BaseCriteriaDto;
import pl.banhangtichluy.dto.criteria.FilterResource;
import pl.banhangtichluy.dto.views.UserView;
import pl.banhangtichluy.entity.*;
import pl.banhangtichluy.reponsitory.UserRepository;
import pl.banhangtichluy.utils.ClassUtils;

import javax.persistence.metamodel.SingularAttribute;
import java.util.List;
import java.util.Optional;

@Service
public class UserService {

    @Autowired
    UserRepository userRepository;
    @Autowired
    PasswordEncoder passwordEncoder;

    private final Class VIEW = UserView.class;

    @Transactional(readOnly = true)
    public Page<UserView> list(BaseCriteriaDto criteria) {
        List<String> fields = ClassUtils.getFieldNameOfClassHasType(User_.class, SingularAttribute.class);
        List<FilterResource> filters = criteria.getListFilterResource();
        if (filters.size() > 0) {
            FilterResource fr = filters.get(0);
            String field = fr.getField();
            String value = fr.getValue();
            if (fields.contains(field)) {
                Specification condition = null;
                switch (field) {
                    case User_.USERNAME:
                        return userRepository.findByUsernameContaining(value, VIEW, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                    case User_.FIRST_NAME:
                        return userRepository.findByFirstNameContaining(value, VIEW, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                    case User_.LAST_NAME:
                        return userRepository.findByLastNameContaining(value, VIEW, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                    case User_.EMAIL:
                        return userRepository.findByEmailContaining(value, VIEW, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                    case User_.PHONE:
                        return userRepository.findByPhoneContaining(value, VIEW, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                    case User_.NOTE:
                        return userRepository.findByNoteContaining(value, VIEW, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
                }
            }
        }
        return userRepository.findBy(VIEW, PageRequest.of(criteria.getPage(), criteria.getSize(), criteria.getSortChain(fields)));
    }

    @Transactional(readOnly = true)
    public Optional<UserView> detailById(Long id) {
        return userRepository.findById(id, VIEW);
    }

    @Transactional(readOnly = true)
    public Optional<UserView> detailByUsername(String username) {
        return userRepository.findByUsername(username, VIEW);
    }


    public Optional<UserView> create(UserDto userDto, User createdBy) {
        if (userRepository.countByUsername(userDto.getUsername()) > 0) {
            throw new ResponseStatusException(HttpStatus.INTERNAL_SERVER_ERROR, "Username already exists");
        }
        User user = new User();
        user.setUsername(userDto.getUsername());
        user.setPassword(passwordEncoder.encode(userDto.getPassword()));
        user.setFirstName(userDto.getFirstName());
        user.setLastName(userDto.getLastName());
        user.setEmail(userDto.getEmail());
        user.setPhone(userDto.getPhone());
        user.setNote(userDto.getNote());
        Long id = userRepository.save(user).getId();
        return detailById(id);
    }

    public Optional<UserView> update(Long id, UserDto userDto, User updatedBy) {
        if (userRepository.countByUsernameExceptId(userDto.getUsername(), id) > 0) {
            throw new ResponseStatusException(HttpStatus.INTERNAL_SERVER_ERROR, "Username already exists");
        }
        User user = userRepository.findById(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        user.setUsername(userDto.getUsername());
        user.setPassword(passwordEncoder.encode(userDto.getPassword()));
        user.setFirstName(userDto.getFirstName());
        user.setLastName(userDto.getLastName());
        user.setEmail(userDto.getEmail());
        user.setPhone(userDto.getPhone());
        user.setNote(userDto.getNote());
        userRepository.save(user);
        return detailById(id);
    }

    public Optional<UserView> updatePersonalInfo(Long id, PersonalInfoUserDto infoUserDto, User updatedBy) {
        User user = userRepository.findById(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        user.setFirstName(infoUserDto.getFirstName());
        user.setLastName(infoUserDto.getLastName());
        user.setEmail(infoUserDto.getEmail());
        user.setPhone(infoUserDto.getPhone());
        user.setNote(infoUserDto.getNote());
        userRepository.save(user);
        return detailById(id);
    }

    public Optional<UserView> updatePassword(Long id, PasswordUserDto infoUserDto, User updatedBy) {
        User user = userRepository.findById(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        user.setPassword(passwordEncoder.encode(infoUserDto.getPassword()));
        userRepository.save(user);
        return detailById(id);
    }

    public boolean delete(Long id) {
        User user = userRepository.findById(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        userRepository.delete(user);
        return true;
    }

}
