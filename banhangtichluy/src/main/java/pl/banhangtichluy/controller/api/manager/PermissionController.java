package pl.banhangtichluy.controller.api.manager;

import io.swagger.annotations.Api;
import io.swagger.annotations.ApiOperation;
import io.swagger.annotations.ApiParam;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.dto.views.v2.PermissionView;
import pl.banhangtichluy.service.PermissionService;

import java.util.List;

@RestController
@RequestMapping("${spring.data.rest.base-path.manager}/permissions")
@Api(tags = "Permission", description = "Permission Resource API")
@ApiOperation(value = "${spring.data.rest.base-path.manager}/permissions", tags = "Permission Resource")
public class PermissionController {

    @Autowired
    PermissionService permissionService;

    @PreAuthorize("hasAuthority('PERMISSION.READ')")
    @GetMapping("")
    @ApiOperation(value = "List of permissions")
    public List<PermissionView> list() {
        return permissionService.list();
    }

    @PreAuthorize("hasAuthority('PERMISSION.READ')")
    @GetMapping("/{identifier}")
    @ApiOperation(value = "Get detailed information of permission by id or name")
    public PermissionView detail(
            @ApiParam(name = "identifier", value = "Identifier of permission", required = true) @PathVariable("identifier") String identifier,
            @ApiParam(name = "mode", value = "Specify find by id or name (allow 2 value 'id' or 'name')") @RequestParam(name = "mode", required = false, defaultValue = "id") String mode
    ) {
        if (mode.trim().toLowerCase().equals("name")) {
            return permissionService.detailByName(identifier).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Name Permission does not exist"));
        }
        return permissionService.detailById(Long.parseLong(identifier)).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Permission does not exist"));
    }
}
