package pl.banhangtichluy.service;

import com.querydsl.core.types.OrderSpecifier;
import com.querydsl.core.types.dsl.PathBuilder;
import com.querydsl.jpa.JPQLQuery;
import com.querydsl.jpa.impl.JPAQueryFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.http.HttpStatus;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.constants.QuerydslConstant;
import pl.banhangtichluy.dto.PasswordUserDto;
import pl.banhangtichluy.dto.PersonalInfoUserDto;
import pl.banhangtichluy.dto.UserDto;
import pl.banhangtichluy.dto.criteria.BaseCriteriaDto;
import pl.banhangtichluy.dto.views.v2.UserView;
import pl.banhangtichluy.entity.QUser;
import pl.banhangtichluy.entity.User;
import pl.banhangtichluy.reponsitory.UserRepository;
import pl.banhangtichluy.utils.FilterCriteriaUtils;
import pl.banhangtichluy.utils.SortCriteriaUtils;

import java.util.Optional;

@Service
public class UserService {

    @Autowired
    JPAQueryFactory query;
    @Autowired
    UserRepository userRepository;
    @Autowired
    PasswordEncoder passwordEncoder;

    private final QUser user = QUser.user;

    @Transactional(readOnly = true)
    public Page<UserView> list(BaseCriteriaDto criteria) {
        PathBuilder<User> pathBuilder = new PathBuilder<User>(User.class, user.getMetadata().getName(), QuerydslConstant.PATH_BUILDER_VALIDATOR);
        JPQLQuery<UserView> jpql = query
                .from(user)
                .where(FilterCriteriaUtils.getPredicates(pathBuilder, criteria.getFilter()))
                .select(UserView.PROJECTIONS)
                .orderBy(SortCriteriaUtils.getOrderSpecifiers(pathBuilder, criteria.getSort()).toArray(new OrderSpecifier[0]));
        return userRepository.findAll(jpql, PageRequest.of(criteria.getPage(), criteria.getSize()));
    }

    @Transactional(readOnly = true)
    public Optional<UserView> detailById(Long id) {
        JPQLQuery<UserView> jpql = query
                .from(user)
                .where(user.id.eq(id))
                .select(UserView.PROJECTIONS);
        return userRepository.findOne(jpql);
    }

    @Transactional(readOnly = true)
    public Optional<UserView> detailByUsername(String username) {
        JPQLQuery<UserView> jpql = query
                .from(user)
                .where(user.username.eq(username))
                .select(UserView.PROJECTIONS);
        return userRepository.findOne(jpql);
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
