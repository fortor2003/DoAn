package pl.banhangtichluy.controller.api.manager;

import com.github.javafaker.Faker;
import com.github.javafaker.Name;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.http.HttpStatus;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.dto.PasswordUserDto;
import pl.banhangtichluy.dto.PersonalInfoUserDto;
import pl.banhangtichluy.dto.UserDto;
import pl.banhangtichluy.dto.criteria.BaseCriteriaDto;
import pl.banhangtichluy.dto.views.UserView;
import pl.banhangtichluy.entity.User;
import pl.banhangtichluy.reponsitory.UserRepository;
import pl.banhangtichluy.service.UserService;

import javax.validation.Valid;
import java.util.Locale;
import java.util.Random;

@RestController
@RequestMapping("${spring.data.rest.base-path.manager}/tests")
public class TestController {

    @Autowired
    UserRepository userRepository;
    @Autowired
    UserService userService;
    @Autowired
    PasswordEncoder passwordEncoder;


    @GetMapping("/create-example-data")
    public String createDataExample() throws Exception {
        String str = "";
        for (int i = 1; i <= 2; i++) {
            for (int j = 1; j <= 20; j++) {
                str += String.format(
                        "INSERT INTO `role_permission` (`role_id`, `permission_id`) VALUES ('%s', '%s');\n",
                        i, j
                );
            }
        }
        for (int j = 13; j <= 20; j++) {
            str += String.format(
                    "INSERT INTO `role_permission` (`role_id`, `permission_id`) VALUES ('%s', '%s');\n",
                    3, j
            );
        }
        return str;
    }


}
