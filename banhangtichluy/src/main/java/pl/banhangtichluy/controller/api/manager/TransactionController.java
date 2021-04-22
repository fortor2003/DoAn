package pl.banhangtichluy.controller.api.manager;

import com.github.javafaker.Faker;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.http.HttpStatus;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.dto.criteria.BaseCriteriaDto;
import pl.banhangtichluy.dto.views.v2.TransactionView;
import pl.banhangtichluy.reponsitory.AmountRepository;
import pl.banhangtichluy.reponsitory.TransactionRepository;
import pl.banhangtichluy.reponsitory.UserRepository;
import pl.banhangtichluy.service.TransactionService;

import javax.validation.Valid;
import java.util.Locale;
import java.util.Random;

@RestController
@RequestMapping("${spring.data.rest.base-path.manager}/transactions")
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
    public Page<TransactionView> list(@Valid BaseCriteriaDto criteriaDto) {
        return transactionService.list(criteriaDto);
    }

    @PreAuthorize("hasAuthority('TRANSACTION.READ')")
    @GetMapping("/{id}")
    public TransactionView detail(@PathVariable("id") String id, @RequestParam(name = "mode", required = false, defaultValue = "id") String mode) {
        if (mode.trim().toLowerCase().equals("code")) {
            return transactionService.detailByCode(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Code Transaction does not exist"));
        }
        return transactionService.detailById(Long.parseLong(id)).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Transaction does not exist"));
    }

    @GetMapping("/create-example-data")
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
