package pl.banhangtichluy.controller.api.manager;

import com.github.javafaker.Faker;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.http.HttpStatus;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.dto.AddValueAmountDto;
import pl.banhangtichluy.dto.AmountDto;
import pl.banhangtichluy.dto.criteria.BaseCriteriaDto;
import pl.banhangtichluy.dto.views.AmountView;
import pl.banhangtichluy.entity.Amount;
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

    @GetMapping("")
    public Page<AmountView> list(@Valid BaseCriteriaDto criteriaDto) {
        return ammountService.list(criteriaDto);
    }

    @GetMapping("/{id}")
    public AmountView detail(@PathVariable("id") Long id) {
        return ammountService.detailById(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
    }

    @GetMapping("/{type}/{code}")
    public AmountView detailByTypeAndCode(@PathVariable("type") String type, @PathVariable("code") String code) {
        return ammountService.detailByTypeAndCode(type, code).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Type and code of Amount do not exist"));
    }

    @PostMapping("")
    public AmountView create(@Valid @RequestBody AmountDto amountDto) {
        User createdBy = userRepository.findById(2L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        return ammountService.create(amountDto, createdBy).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
    }

    @PutMapping("{id}")
    public AmountView update(@PathVariable("id") Long id, @Valid @RequestBody AmountDto amountDto) {
        User updatedBy = userRepository.findById(1L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        return ammountService.update(id, amountDto, updatedBy).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
    }

    @PutMapping("{id}/add-value")
    public AmountView addValue(@PathVariable("id") Long id, @Valid @RequestBody AddValueAmountDto addValueAmountDto) {
        User updatedBy = userRepository.findById(1L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        return ammountService.addValue(id, addValueAmountDto, updatedBy).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
    }

    @DeleteMapping("{id}")
    public boolean delete(@PathVariable("id") Long id) {
        return ammountService.delete(id);
    }

//    @GetMapping("/test")
//    public int test() {
//        return amountRepository.countByTypeAndCodeExceptId("GIFT", "914885456727758", 234L);
////        return amountRepository.findByLastNameContaining("minh", AmountView.class, PageRequest.of(0,10));
////        return amountRepository.findByTypeEqualsAndCodeEquals("POINT", "496825560132459", AmountView.class).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID Amount does not exist"));
//    }

    @GetMapping("/create-example-data")
    public String createDataExample() throws Exception {
        Faker faker = new Faker(new Locale("vi"));
        Random random = new Random();
        User u1 = userRepository.findById(1L).orElseThrow(() -> new Exception("U1 not found"));
        User u2 = userRepository.findById(2L).orElseThrow(() -> new Exception("U2 not found"));
        for (int i = 0; i < 200; i++) {
            Amount amount = new Amount();
            amount.setType(AmountType.values()[random.nextInt(AmountType.values().length)].name());
            amount.setCode(faker.code().imei());
            amount.setValue(faker.random().nextInt(0, 8000));
            amount.setFirstName(faker.name().firstName());
            amount.setLastName(faker.name().lastName());
            amount.setPhone(faker.phoneNumber().phoneNumber());
            amount.setEmail(faker.bothify("????##@example.com"));
            amount.setNote(faker.lorem().characters(5, 30));
            amount.setCreatedBy(i % 2 == 0 ? u1 : u2);
            amountRepository.save(amount);
        }
        return "OK";
    }

}
