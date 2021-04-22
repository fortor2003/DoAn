package pl.banhangtichluy.controller.api.manager;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.dto.views.RoleView;
import pl.banhangtichluy.service.RoleService;

import java.util.List;

@RestController
@RequestMapping("${spring.data.rest.base-path.manager}/roles")
public class RoleController {

    @Autowired
    RoleService roleService;

    @PreAuthorize("hasAuthority('ROLE.READ')")
    @GetMapping("")
    public List<RoleView> list() {
        return roleService.list();
    }

    @PreAuthorize("hasAuthority('ROLE.READ')")
    @GetMapping("/{id}")
    public RoleView detail(@PathVariable("id") String id, @RequestParam(name = "mode", required = false, defaultValue = "id") String mode) {
        if (mode.trim().toLowerCase().equals("name")) {
            return roleService.detailByName(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Name Role does not exist"));
        }
        return roleService.detailById(Long.parseLong(id)).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Role does not exist"));
    }
}
