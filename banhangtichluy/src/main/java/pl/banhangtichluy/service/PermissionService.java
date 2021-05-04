package pl.banhangtichluy.service;

import com.querydsl.core.types.dsl.PathBuilder;
import com.querydsl.jpa.JPQLQuery;
import com.querydsl.jpa.impl.JPAQueryFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import pl.banhangtichluy.constants.QuerydslConstant;
import pl.banhangtichluy.dto.views.PermissionView;
import pl.banhangtichluy.entity.Permission;
import pl.banhangtichluy.entity.QPermission;
import pl.banhangtichluy.reponsitory.PermissionRepository;

import java.util.List;
import java.util.Optional;

@Service
public class PermissionService {

    @Autowired
    JPAQueryFactory query;
    @Autowired
    PermissionRepository permissionRepository;

    private final QPermission permission = QPermission.permission;

    public List<PermissionView> list() {
        PathBuilder<Permission> pathBuilder = new PathBuilder<Permission>(Permission.class, permission.getMetadata().getName(), QuerydslConstant.PATH_BUILDER_VALIDATOR);
        JPQLQuery<PermissionView> jpql = query
                .from(permission)
                .select(PermissionView.PROJECTIONS);
        return permissionRepository.findAll(jpql);
    }

    public Optional<PermissionView> detailById(Long id) {
        JPQLQuery<PermissionView> jpql = query
                .from(permission)
                .where(permission.id.eq(id))
                .select(PermissionView.PROJECTIONS);
        return permissionRepository.findOne(jpql);
    }

    public Optional<PermissionView> detailByName(String name) {
        JPQLQuery<PermissionView> jpql = query
                .from(permission)
                .where(permission.name.equalsIgnoreCase(name))
                .select(PermissionView.PROJECTIONS);
        return permissionRepository.findOne(jpql);
    }

    public List<String> getAllPermissionNames() {
        JPQLQuery<String> jpql = query
                .from(permission)
                .select(permission.name);
        return permissionRepository.findAll(jpql);
    }
}
