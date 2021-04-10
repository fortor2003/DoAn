package pl.banhangtichluy.controller.api.manager;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.dto.views.PermissionView;
import pl.banhangtichluy.dto.views.RoleView;
import pl.banhangtichluy.service.PermissionService;

import java.util.List;

@RestController
@RequestMapping("${spring.data.rest.base-path.manager}/permissions")
public class PermissionController {

    @Autowired
    PermissionService permissionService;

    @GetMapping("")
    public List<PermissionView> list() {
        return permissionService.list();
    }

    @GetMapping("/{id}")
    public PermissionView detail(@PathVariable("id") String id, @RequestParam(name = "mode", required = false, defaultValue = "id") String mode) {
        if (mode.trim().toLowerCase().equals("name")) {
            return permissionService.detailByName(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Name Permission does not exist"));
        }
        return permissionService.detailById(Long.parseLong(id)).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Permission does not exist"));
    }
}
