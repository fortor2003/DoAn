package pl.banhangtichluy.controller.api.manager;

import com.github.javafaker.Faker;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;
import pl.banhangtichluy.entity.User;
import pl.banhangtichluy.reponsitory.UserRepository;

import java.util.Locale;
import java.util.Random;

@RestController
@RequestMapping("${spring.data.rest.base-path.manager}/users")
public class UserController {

    @Autowired
    UserRepository userRepository;

//    @GetMapping("/create-example-data")
//    public String createDataExample() throws Exception {
//        Faker faker = new Faker(new Locale("vi"));
//        Random random = new Random();
//        for (int i = 0; i < 10; i++) {
//            User user = new User();
//            String username = faker.name().username();
//            user.setUsername(username);
//            user.setPassword(faker.crypto().md5());
//            user.setFirstName(faker.name().firstName());
//            user.setLastName(faker.name().lastName());
//            user.setEmail(username + "@example.com");
//            user.setPhone(faker.phoneNumber().phoneNumber());
//            user.setNote(faker.lorem().characters(5, 50, true));
//            userRepository.save(user);
//        }
//        return "OK";
//    }


}
