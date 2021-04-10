package pl.banhangtichluy.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import pl.banhangtichluy.dto.views.RoleView;
import pl.banhangtichluy.reponsitory.RoleRepository;

import java.util.List;
import java.util.Optional;

@Service
public class RoleService {

    @Autowired
    RoleRepository roleRepository;

    private final Class VIEW = RoleView.class;

    public List<RoleView> list() {
        return roleRepository.findBy(VIEW);
    }

    public Optional<RoleView> detailById(Long id) {
        return roleRepository.findById(id, VIEW);
    }

    public Optional<RoleView> detailByName(String name) {
        return roleRepository.findByName(name, VIEW);
    }
}
