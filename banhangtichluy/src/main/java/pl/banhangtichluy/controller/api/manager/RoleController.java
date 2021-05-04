package pl.banhangtichluy.controller.api.manager;

import io.swagger.annotations.Api;
import io.swagger.annotations.ApiOperation;
import io.swagger.annotations.ApiParam;
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
@Api(tags = "Role", description = "Role Resource API")
@ApiOperation(value = "${spring.data.rest.base-path.manager}/roles", tags = "Role Resource")
public class RoleController {

    @Autowired
    RoleService roleService;

    @PreAuthorize("hasAuthority('ROLE.READ')")
    @GetMapping("")
    @ApiOperation(value = "List of role")
    public List<RoleView> list() {
        return roleService.list();
    }

    @PreAuthorize("hasAuthority('ROLE.READ')")
    @GetMapping("/{identifier}")
    @ApiOperation(value = "Get detailed information of role by id or name")
    public RoleView detail(
            @ApiParam(name = "identifier", value = "Identifier of role", required = true) @PathVariable("identifier") String identifier,
            @ApiParam(name = "mode", value = "Specify find by id or name (allow 2 value 'id' or 'name')") @RequestParam(name = "mode", required = false, defaultValue = "id") String mode
    ) {
        if (mode.trim().toLowerCase().equals("name")) {
            return roleService.detailByName(identifier).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Name Role does not exist"));
        }
        return roleService.detailById(Long.parseLong(identifier)).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Role does not exist"));
    }
}
