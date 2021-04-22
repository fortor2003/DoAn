package pl.banhangtichluy.service;

import com.querydsl.jpa.JPQLQuery;
import com.querydsl.jpa.impl.JPAQueryFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import pl.banhangtichluy.dto.views.PermissionView;
import pl.banhangtichluy.dto.views.RoleView;
import pl.banhangtichluy.dto.views.TransactionView;
import pl.banhangtichluy.entity.QPermission;
import pl.banhangtichluy.reponsitory.PermissionRepository;

import java.util.List;
import java.util.Optional;

@Service
public class PermissionService {

    @Autowired
    PermissionRepository permissionRepository;
    @Autowired
    JPAQueryFactory query;

    private final QPermission qPermission = QPermission.permission;
    private final Class VIEW = PermissionView.class;

    public List<PermissionView> list() {
        return permissionRepository.findBy(VIEW);
    }

    public Optional<PermissionView> detailById(Long id) {
        return permissionRepository.findById(id, VIEW);
    }

    public Optional<PermissionView> detailByName(String name) {
        return permissionRepository.findByName(name, VIEW);
    }

    public List<String> getAllPermissionNames() {
        JPQLQuery<String> jpql = query.from(qPermission).select(qPermission.name).orderBy(qPermission.name.asc());
        return permissionRepository.findAll(jpql);
    }
}
