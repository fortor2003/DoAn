package pl.banhangtichluy.controller.api.manager;

import com.github.javafaker.Faker;
import com.github.javafaker.Name;
import io.swagger.annotations.*;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.http.HttpStatus;
import org.springframework.http.MediaType;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.validation.ObjectError;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.constants.EntityPropsDescriptionConstant;
import pl.banhangtichluy.dto.AddValueAmountDto;
import pl.banhangtichluy.dto.AmountDto;
import pl.banhangtichluy.dto.criteria.BaseCriteriaDto;
import pl.banhangtichluy.dto.views.v2.AmountView;
import pl.banhangtichluy.entity.User;
import pl.banhangtichluy.enums.AmountType;
import pl.banhangtichluy.reponsitory.AmountRepository;
import pl.banhangtichluy.reponsitory.UserRepository;
import pl.banhangtichluy.service.AmountService;

import javax.validation.Valid;
import java.util.List;
import java.util.Locale;
import java.util.Random;

@RestController
@RequestMapping("${spring.data.rest.base-path.manager}/amounts")
@Api(tags = "Amounts", description = "Amount Resource API")
@ApiOperation(value = "${spring.data.rest.base-path.manager}/amounts", tags = "Amount Resource")
//@ApiResponses(value = {
//        @ApiResponse(code = 200, message = "OK"),
//        @ApiResponse(code = 400, message = "Bad Request", response = List<ObjectError>),
//        @ApiResponse(code = 401, message = "Unauthorized", response = String.class),
//        @ApiResponse(code = 403, message = "Forbidden", response = String.class),
//        @ApiResponse(code = 404, message = "Not Found", response = String.class),
//        @ApiResponse(code = 500, message = "Internal Server Error", response = String.class),
//})
public class AmountController {

    @Autowired
    AmountService ammountService;
    @Autowired
    AmountRepository amountRepository;
    @Autowired
    UserRepository userRepository;

    @PreAuthorize("hasAuthority('AMOUNT.READ')")
    @GetMapping("")
    @ApiOperation(value = "List of amounts")
    public Page<AmountView> list(@Valid BaseCriteriaDto criteriaDto) {
        return ammountService.list(criteriaDto);
    }

    @PreAuthorize("hasAuthority('AMOUNT.READ')")
    @GetMapping("{id}")
    @ApiOperation(value = "Get detailed information of amount by id")
    public AmountView detail(@ApiParam(name = "id", value = EntityPropsDescriptionConstant.AmountProps.ID, example = "100", required = true) @PathVariable("id") Long id) {
        return ammountService.detailById(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
    }

    @PreAuthorize("hasAuthority('AMOUNT.READ')")
    @GetMapping("{type}/{code}")
    @ApiOperation(value = "Get detailed information of amount by type and code")
    public AmountView detailByTypeAndCode(
            @ApiParam(name = "type", value = EntityPropsDescriptionConstant.AmountProps.TYPE, example = "POINT", required = true) @PathVariable("type") String type,
            @ApiParam(name = "code", value = EntityPropsDescriptionConstant.AmountProps.CODE, example = "ABCDEF123456", required = true) @PathVariable("code") String code) {
        return ammountService.detailByTypeAndCode(type, code).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Type and code of Amount do not exist"));
    }

//    @PreAuthorize("hasAuthority('AMOUNT.CREATE')")
    @PostMapping("")
//    @ApiOperation(value = "Create new amount")
    public AmountView create(@Valid @RequestBody AmountDto amountDto) {
        User createdBy = userRepository.findById(2L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        return ammountService.create(amountDto, createdBy).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
    }

    @PreAuthorize("hasAuthority('AMOUNT.UPDATE')")
    @PutMapping("{id}") // admin update
    @ApiOperation(value = "Update information of amount")
    public AmountView update(@PathVariable("id") Long id, @Valid @RequestBody AmountDto amountDto) {
        User updatedBy = userRepository.findById(1L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        return ammountService.update(id, amountDto, updatedBy).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
    }

    @PreAuthorize("hasAuthority('AMOUNT.UPDATE')")
    @PatchMapping("{id}/add-value") //user update value point
    @ApiOperation(value = "Add value for amount")
    public AmountView addValue(@PathVariable("id") Long id, @Valid @RequestBody AddValueAmountDto addValueAmountDto) {
        User updatedBy = userRepository.findById(1L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        return ammountService.addValue(id, addValueAmountDto, updatedBy).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
    }

    @PreAuthorize("hasAuthority('AMOUNT.DELETE')")
    @DeleteMapping("{id}")
    @ApiOperation(value = "Delete amount")
    public boolean delete(@PathVariable("id") Long id) {
        return ammountService.delete(id);
    }

    @PreAuthorize("hasAuthority('ROLE_ADMIN')")
    @GetMapping("generate-sql-example-data")
    @ApiOperation(value = "Generate SQL insert statement examle data", hidden = true)
    public String createDataExample() {
        String str = "";
        Faker faker = new Faker(new Locale("en"));
        Random random = new Random();
        for (int i = 0; i < 200; i++) {
            Name name = faker.name();
            String username = name.username().replace(".", "");
            str += String.format(
                    "INSERT INTO `amounts` (`type`, `code`, `value`, `first_name`, `last_name`, `email`, `phone`, `note`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');\n",
                    AmountType.values()[random.nextInt(AmountType.values().length)].name(), faker.code().imei(), faker.random().nextInt(0, 8000), name.firstName().replace("'", ""), name.lastName().replace("'", ""), name.firstName() + "@example.com", faker.phoneNumber().phoneNumber(), faker.lorem().characters(5, 30), 1
            );
        }
        return str;
    }

}
