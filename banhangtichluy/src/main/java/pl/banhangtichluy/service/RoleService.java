package pl.banhangtichluy.service;

import com.querydsl.core.types.dsl.PathBuilder;
import com.querydsl.jpa.JPQLQuery;
import com.querydsl.jpa.impl.JPAQueryFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import pl.banhangtichluy.constants.QuerydslConstant;
import pl.banhangtichluy.dto.views.v2.RoleView;
import pl.banhangtichluy.entity.QRole;
import pl.banhangtichluy.entity.Role;
import pl.banhangtichluy.reponsitory.RoleRepository;

import java.util.List;
import java.util.Optional;

@Service
public class RoleService {

    @Autowired
    JPAQueryFactory query;
    @Autowired
    RoleRepository roleRepository;

    private final QRole role = QRole.role;

    public List<RoleView> list() {
        PathBuilder<Role> pathBuilder = new PathBuilder<Role>(Role.class, role.getMetadata().getName(), QuerydslConstant.PATH_BUILDER_VALIDATOR);
        JPQLQuery<RoleView> jpql = query
                .from(role)
                .select(RoleView.PROJECTIONS);
        return roleRepository.findAll(jpql);
    }

    public Optional<RoleView> detailById(Long id) {
        JPQLQuery<RoleView> jpql = query
                .from(role)
                .where(role.id.eq(id))
                .select(RoleView.PROJECTIONS);
        return roleRepository.findOne(jpql);
    }

    public Optional<RoleView> detailByName(String name) {
        JPQLQuery<RoleView> jpql = query
                .from(role)
                .where(role.name.equalsIgnoreCase(name))
                .select(RoleView.PROJECTIONS);
        return roleRepository.findOne(jpql);
    }
}
