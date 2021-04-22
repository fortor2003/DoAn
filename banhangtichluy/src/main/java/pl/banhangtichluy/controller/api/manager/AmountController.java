package pl.banhangtichluy.controller.api.manager;

import com.github.javafaker.Faker;
import com.github.javafaker.Name;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.http.HttpStatus;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.server.ResponseStatusException;
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
import java.util.Locale;
import java.util.Random;

@RestController
@RequestMapping("${spring.data.rest.base-path.manager}/amounts")
public class AmountController {

    @Autowired
    AmountService ammountService;
    @Autowired
    AmountRepository amountRepository;
    @Autowired
    UserRepository userRepository;

    @PreAuthorize("hasAuthority('AMOUNT.READ')")
    @GetMapping("")
    public Page<AmountView> list(@Valid BaseCriteriaDto criteriaDto) {
        return ammountService.list(criteriaDto);
    }

    @PreAuthorize("hasAuthority('AMOUNT.READ')")
    @GetMapping("/{id}")
    public AmountView detail(@PathVariable("id") Long id) {
        return ammountService.detailById(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
    }

    @PreAuthorize("hasAuthority('AMOUNT.READ')")
    @GetMapping("/{type}/{code}")
    public AmountView detailByTypeAndCode(@PathVariable("type") String type, @PathVariable("code") String code) {
        return ammountService.detailByTypeAndCode(type, code).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Type and code of Amount do not exist"));
    }

    @PreAuthorize("hasAuthority('AMOUNT.CREATE')")
    @PostMapping("")
    public AmountView create(@Valid @RequestBody AmountDto amountDto) {
        User createdBy = userRepository.findById(2L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        return ammountService.create(amountDto, createdBy).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
    }

    @PreAuthorize("hasAuthority('AMOUNT.UPDATE')")
    @PutMapping("{id}") // admin update
    public AmountView update(@PathVariable("id") Long id, @Valid @RequestBody AmountDto amountDto) {
        User updatedBy = userRepository.findById(1L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        return ammountService.update(id, amountDto, updatedBy).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
    }

    @PreAuthorize("hasAuthority('AMOUNT.UPDATE')")
    @PatchMapping("{id}/add-value") //user update value point
    public AmountView addValue(@PathVariable("id") Long id, @Valid @RequestBody AddValueAmountDto addValueAmountDto) {
        User updatedBy = userRepository.findById(1L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        return ammountService.addValue(id, addValueAmountDto, updatedBy).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
    }

    @PreAuthorize("hasAuthority('AMOUNT.DELETE')")
    @DeleteMapping("{id}")
    public boolean delete(@PathVariable("id") Long id) {
        return ammountService.delete(id);
    }

    @GetMapping("/create-example-data")
    public String createDataExample() throws Exception {
        String str = "";
        Faker faker = new Faker(new Locale("en"));
        Random random = new Random();
        for (int i = 0; i < 200; i++) {
            Name name = faker.name();
            String username = name.username().replace(".", "");
            str += String.format(
                    "INSERT INTO `amounts` (`type`, `code`, `value`, `first_name`, `last_name`, `email`, `phone`, `note`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');\n",
                    AmountType.values()[random.nextInt(AmountType.values().length)].name(), faker.code().imei(), faker.random().nextInt(0, 8000), name.firstName().replace("'", ""), name.lastName().replace("'", ""), name.firstName()+"@example.com",faker.phoneNumber().phoneNumber(),faker.lorem().characters(5, 30), 1
            );
        }
        return str;
    }

}
