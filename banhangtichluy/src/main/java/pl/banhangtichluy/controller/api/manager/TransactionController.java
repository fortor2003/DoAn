package pl.banhangtichluy.controller.api.manager;

import com.github.javafaker.Faker;
import io.swagger.annotations.Api;
import io.swagger.annotations.ApiOperation;
import io.swagger.annotations.ApiParam;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.http.HttpStatus;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.constants.EntityPropsDescriptionConstant;
import pl.banhangtichluy.dto.criteria.BaseCriteriaDto;
import pl.banhangtichluy.dto.views.TransactionView;
import pl.banhangtichluy.reponsitory.AmountRepository;
import pl.banhangtichluy.reponsitory.TransactionRepository;
import pl.banhangtichluy.reponsitory.UserRepository;
import pl.banhangtichluy.service.TransactionService;

import javax.validation.Valid;
import java.util.Locale;
import java.util.Random;

@RestController
@RequestMapping("${spring.data.rest.base-path.manager}/transactions")
@Api(tags = "Transaction", description = "Transaction Resource API")
@ApiOperation(value = "${spring.data.rest.base-path.manager}/transactions", tags = "Transaction Resource")
public class TransactionController {

    @Autowired
    AmountRepository amountRepository;
    @Autowired
    TransactionRepository transactionRepository;
    @Autowired
    UserRepository userRepository;
    @Autowired
    TransactionService transactionService;

    @PreAuthorize("hasAuthority('TRANSACTION.READ')")
    @GetMapping("")
    @ApiOperation(value = "List of transactions")
    public Page<TransactionView> list(@Valid BaseCriteriaDto criteriaDto) {
        return transactionService.list(criteriaDto);
    }

    @PreAuthorize("hasAuthority('TRANSACTION.READ')")
    @GetMapping("/{id}")
    @ApiOperation(value = "Get detailed information of transaction by id or code")
    public TransactionView detail(
            @ApiParam(name = "id", value = EntityPropsDescriptionConstant.TransactionProps.ID, required = true) @PathVariable("id") String id,
            @ApiParam(name = "mode", value = "Specify find by id or code (allow 2 value 'id' or 'code')") @RequestParam(name = "mode", required = false, defaultValue = "id") String mode
    ) {
        if (mode.trim().toLowerCase().equals("code")) {
            return transactionService.detailByCode(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Code Transaction does not exist"));
        }
        return transactionService.detailById(Long.parseLong(id)).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Transaction does not exist"));
    }

    @PreAuthorize("hasAuthority('ROLE_ADMIN')")
    @GetMapping("generate-sql-example-data")
    @ApiOperation(value = "Generate SQL insert statement example data", hidden = true)
    public String createDataExample() throws Exception {
        String str = "";
        Faker faker = new Faker(new Locale("vi"));
        Random random = new Random();
        for (int i = 0; i < 200; i++) {
            Integer before = faker.random().nextInt(0, 8000);
            Integer plus = faker.random().nextInt(0, 2000);
            str += String.format(
                    "INSERT INTO `transactions` (`code`, `amount_id`, `before_value`, `plus_value`, `after_value`, `note`, `created_by`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s');\n",
                    faker.code().imei(), i + 1, before, plus, before + plus, faker.lorem().characters(5, 30), 1
            );
        }
        return str;
    }

}
