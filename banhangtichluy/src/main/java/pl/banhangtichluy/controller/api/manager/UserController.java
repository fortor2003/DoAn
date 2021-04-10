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
@RequestMapping("${spring.data.rest.base-path.manager}/users")
public class UserController {

    @Autowired
    UserRepository userRepository;
    @Autowired
    UserService userService;
    @Autowired
    PasswordEncoder passwordEncoder;

    @GetMapping("")
    public Page<UserView> list(@Valid BaseCriteriaDto criteriaDto) {
        return userService.list(criteriaDto);
    }

    @GetMapping("/{id}")
    public UserView detail(@PathVariable("id") String id, @RequestParam(name = "mode", required = false, defaultValue = "id") String mode) {
        if (mode.trim().toLowerCase().equals("username")) {
            return userService.detailByUsername(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Username does not exist"));
        }
        return userService.detailById(Long.parseLong(id)).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
    }

    @PostMapping("")
    public UserView create(@Valid @RequestBody UserDto userDto) {
        User createdBy = userRepository.findById(2L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        return userService.create(userDto, createdBy).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
    }

    @PutMapping("{id}/personal-info")
    public UserView updatePersonalInfo(@PathVariable("id") Long id, @Valid @RequestBody PersonalInfoUserDto dto) {
        User updatedBy = userRepository.findById(1L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        return userService.updatePersonalInfo(id, dto, updatedBy).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
    }

    @PutMapping("{id}/password")
    public UserView updatePassword(@PathVariable("id") Long id, @Valid @RequestBody PasswordUserDto dto) {
        User updatedBy = userRepository.findById(1L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        return userService.updatePassword(id, dto, updatedBy).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
    }

    @DeleteMapping("{id}")
    public boolean delete(@PathVariable("id") Long id) {
        return userService.delete(id);
    }


    @GetMapping("/create-example-data")
    public String createDataExample() throws Exception {
        String str = "";
        Faker faker = new Faker(new Locale("en"));
        Random random = new Random();
        for (int i = 0; i < 20; i++) {
            Name name = faker.name();
            String username = name.username().replace(".", "");
//            user.setUsername(username);
//            user.setPassword(faker.crypto().md5());
//            user.setFirstName(faker.name().firstName());
//            user.setLastName(faker.name().lastName());
//            user.setEmail(username + "@example.com");
//            user.setPhone(faker.phoneNumber().phoneNumber());
//            user.setNote(faker.lorem().characters(5, 50, true));
            str += String.format(
                    "INSERT INTO `points`.`users` (`username`, `password`, `first_name`, `last_name`, `email`, `phone`, `note`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s');\n",
                    username, passwordEncoder.encode(username), name.firstName(), name.lastName(), username+"@example.com", faker.phoneNumber().phoneNumber(), faker.lorem().characters(5, 50, true)
            );

        }
        return str;
    }


}
