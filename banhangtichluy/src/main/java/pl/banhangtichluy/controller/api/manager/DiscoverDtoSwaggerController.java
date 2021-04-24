package pl.banhangtichluy.controller.api.manager;

import io.swagger.annotations.ApiOperation;
import io.swagger.annotations.ApiParam;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;
import pl.banhangtichluy.constants.EntityPropsDescriptionConstant;
import pl.banhangtichluy.dto.response.FormErrorDto;

@RestController
@RequestMapping("${spring.data.rest.base-path.manager}/discover-dto")
@ApiOperation(value = "${spring.data.rest.base-path.manager}/discover-dto", tags = "Discover Dto")

public class DiscoverDtoSwaggerController {


    @PreAuthorize("hasAuthority('AMOUNT.READ')")
    @GetMapping("")
    @ApiOperation(value = "Get detailed information of amount by type and code")
    public String discoverDto(
            @ApiParam(name = "type1", value = EntityPropsDescriptionConstant.AmountProps.TYPE, example = "POINT", required = true) FormErrorDto type1
    ) {
        return "OK";
    }

}
