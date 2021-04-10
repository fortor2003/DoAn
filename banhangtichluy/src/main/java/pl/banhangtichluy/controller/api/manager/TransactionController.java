package pl.banhangtichluy.controller.api.manager;

import com.github.javafaker.Faker;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.http.HttpStatus;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.dto.AmountDto;
import pl.banhangtichluy.dto.criteria.BaseCriteriaDto;
import pl.banhangtichluy.dto.views.AmountView;
import pl.banhangtichluy.dto.views.TransactionView;
import pl.banhangtichluy.entity.Amount;
import pl.banhangtichluy.entity.Transaction;
import pl.banhangtichluy.entity.User;
import pl.banhangtichluy.enums.AmountType;
import pl.banhangtichluy.reponsitory.AmountRepository;
import pl.banhangtichluy.reponsitory.TransactionRepository;
import pl.banhangtichluy.reponsitory.UserRepository;
import pl.banhangtichluy.service.AmountService;
import pl.banhangtichluy.service.TransactionService;
import pl.banhangtichluy.utils.WebUtils;

import javax.validation.Valid;
import java.text.DecimalFormat;
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

    @GetMapping("")
    public Page<TransactionView> list(@Valid BaseCriteriaDto criteriaDto) {
        return transactionService.list(criteriaDto);
    }

    @GetMapping("/{id}")
    public TransactionView detail(@PathVariable("id") String id, @RequestParam(name = "mode", required = false, defaultValue = "id") String mode) {
        if (mode.trim().toLowerCase().equals("code")) {
            return transactionService.detailByCode(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Code Transaction does not exist"));
        }
        return transactionService.detailById(Long.parseLong(id)).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Transaction does not exist"));
    }

//
//    @PostMapping("")
//    public AmountView create(@Valid @RequestBody AmountDto amountDto) {
//        User createdBy = userRepository.findById(2L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
//        return ammountService.create(amountDto, createdBy).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
//    }
//
//    @PutMapping("{id}")
//    public AmountView update(@PathVariable("id") Long id, @Valid @RequestBody AmountDto amountDto) {
//        User updatedBy = userRepository.findById(1L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
//        return ammountService.update(id, amountDto, updatedBy).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
//    }
//
//    @DeleteMapping("{id}")
//    public boolean delete(@PathVariable("id") Long id) {
//        return ammountService.delete(id);
//    }
//
//    @GetMapping("/test")
//    public int test() {
//        return amountRepository.countByTypeAndCodeExceptId("GIFT", "914885456727758", 234L);
////        return amountRepository.findByLastNameContaining("minh", AmountView.class, PageRequest.of(0,10));
////        return amountRepository.findByTypeEqualsAndCodeEquals("POINT", "496825560132459", AmountView.class).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
//    }

    @GetMapping("/create-example-data")
    public String createDataExample() throws Exception {
        String str = "";
        Faker faker = new Faker(new Locale("vi"));
        Random random = new Random();
//        User u1 = userRepository.findById(1L).orElseThrow(() -> new Exception("U1 not found"));
//        User u2 = userRepository.findById(2L).orElseThrow(() -> new Exception("U2 not found"));
//        Amount amount = amountRepository.findById(1L).orElse(null);
        for (int i = 0; i < 200; i++) {
            Integer before = faker.random().nextInt(0, 8000);
            Integer plus = faker.random().nextInt(0, 2000);

//            Transaction transaction = new Transaction();
//            transaction.setCode(faker.code().imei());
//            transaction.setBeforeValue(faker.random().nextInt(0, 8000));
//            transaction.setPlusValue(faker.random().nextInt(0, 8000));
//            transaction.setAfterValue(faker.random().nextInt(0, 8000));
//            transaction.setNote(faker.lorem().characters(5, 30));
//            transaction.setAmount(amount);
//            transaction.setCreatedBy(i % 2 == 0 ? u1 : u2);
            str += String.format(
                    "INSERT INTO `transactions` (`code`, `amount_id`, `before_value`, `plus_value`, `after_value`, `note`, `created_by`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s');\n",
                    faker.code().imei(), i + 1, before, plus, before + plus, faker.lorem().characters(5, 30), 1
            );
        }
        return str;
    }

}
