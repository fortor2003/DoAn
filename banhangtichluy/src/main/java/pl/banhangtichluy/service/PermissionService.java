package pl.banhangtichluy.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import pl.banhangtichluy.dto.views.PermissionView;
import pl.banhangtichluy.dto.views.RoleView;
import pl.banhangtichluy.dto.views.TransactionView;
import pl.banhangtichluy.reponsitory.PermissionRepository;

import java.util.List;
import java.util.Optional;

@Service
public class PermissionService {

    @Autowired
    PermissionRepository permissionRepository;

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
}
