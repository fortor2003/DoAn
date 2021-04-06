package pl.banhangtichluy.controller.api.manager;

import com.github.javafaker.Faker;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.web.bind.annotation.*;
import pl.banhangtichluy.dto.criteria.BaseCriteriaDto;
import pl.banhangtichluy.entity.Amount;
import pl.banhangtichluy.enums.AmountType;
import pl.banhangtichluy.service.AmmountService;

import javax.validation.Valid;
import java.util.Locale;
import java.util.Random;

@RestController
@RequestMapping("${spring.data.rest.base-path.manager}/amounts")
public class AmountController {

    @Autowired
    AmmountService ammountService;

    @GetMapping("")
    public Page<Amount> list(@Valid BaseCriteriaDto criteriaDto) {
        return ammountService.list(criteriaDto);
    }

//    @GetMapping("/create-example-data")
//    public String createDataExample() {
//        Faker faker = new Faker(new Locale("vi"));
//        Random random = new Random();
//        for (int i = 0; i < 200; i++) {
//            Amount amount = new Amount();
//            amount.setType(AmountType.values()[random.nextInt(AmountType.values().length)].name());
//            amount.setCode(faker.code().imei());
//            amount.setValue(faker.random().nextInt(0, 8000));
//            amount.setFirstName(faker.name().firstName());
//            amount.setLastName(faker.name().lastName());
//            amount.setPhone(faker.phoneNumber().phoneNumber());
//            amount.setEmail(faker.bothify("????##@example.com"));
//            amount.setNote(faker.lorem().characters(5, 30));
//            amount.setCreatedBy(1L);
//            amount.setUpdatedBy(1L);
//            ammountService.create(amount);
//        }
//        return "OK";
//    }

}
