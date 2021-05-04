package pl.banhangtichluy.controller.api.manager;

import io.swagger.annotations.Api;
import io.swagger.annotations.ApiOperation;
import io.swagger.annotations.ApiParam;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.http.HttpStatus;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.dto.request.PasswordUserDto;
import pl.banhangtichluy.dto.request.PersonalInfoUserDto;
import pl.banhangtichluy.dto.request.UserDto;
import pl.banhangtichluy.dto.criteria.BaseCriteriaDto;
import pl.banhangtichluy.dto.views.UserView;
import pl.banhangtichluy.entity.User;
import pl.banhangtichluy.reponsitory.UserRepository;
import pl.banhangtichluy.service.UserService;

import javax.validation.Valid;

@RestController
@RequestMapping("${spring.data.rest.base-path.manager}/users")
@Api(tags = "User", description = "User Resource API")
@ApiOperation(value = "${spring.data.rest.base-path.manager}/users", tags = "User Resource")
public class UserController {

    @Autowired
    UserRepository userRepository;
    @Autowired
    UserService userService;
    @Autowired
    PasswordEncoder passwordEncoder;

    @PreAuthorize("hasAuthority('USER.READ')")
    @GetMapping("")
    @ApiOperation(value = "List of users")
    public Page<UserView> list(@Valid BaseCriteriaDto criteriaDto) {
        return userService.list(criteriaDto);
    }

    @PreAuthorize("hasAuthority('USER.READ')")
    @GetMapping("{identifier}")
    @ApiOperation(value = "Get detailed information of user by id or username")
    public UserView detail(
            @ApiParam(name = "identifier", value = "Identifier of user", required = true) @PathVariable("identifier") String identifier,
            @ApiParam(name = "mode", value = "Specify find by id or username (allow 2 value 'id' or 'username')") @RequestParam(name = "mode", required = false, defaultValue = "id") String mode
    ) {
        if (mode.trim().toLowerCase().equals("username")) {
            return userService.detailByUsername(identifier).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Username does not exist"));
        }
        return userService.detailById(Long.parseLong(identifier)).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
    }

    @PreAuthorize("hasAuthority('USER.CREATE')")
    @PostMapping("")
    @ApiOperation(value = "Create new user")
    public UserView create(@Valid @RequestBody UserDto userDto) {
        User createdBy = userRepository.findById(2L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        return userService.create(userDto, createdBy).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
    }

    @PreAuthorize("hasAuthority('USER.UPDATE')")
    @PutMapping("{id}/personal-info")
    @ApiOperation(value = "Change personal info of user")
    public UserView updatePersonalInfo(@PathVariable("id") Long id, @Valid @RequestBody PersonalInfoUserDto dto) {
        User updatedBy = userRepository.findById(1L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        return userService.updatePersonalInfo(id, dto, updatedBy).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
    }

    @PreAuthorize("hasAuthority('USER.UPDATE')")
    @PutMapping("{id}/password")
    @ApiOperation(value = "Change password of user")
    public UserView updatePassword(@PathVariable("id") Long id, @Valid @RequestBody PasswordUserDto dto) {
        User updatedBy = userRepository.findById(1L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
        return userService.updatePassword(id, dto, updatedBy).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User does not exist"));
    }

    @PreAuthorize("hasAuthority('USER.DELETE')")
    @DeleteMapping("{id}")
    @ApiOperation(value = "Delete user")
    public boolean delete(@PathVariable("id") Long id) {
        return userService.delete(id);
    }

//    @GetMapping("/create-example-data")
//    public String createDataExample() throws Exception {
//        String str = "";
//        Faker faker = new Faker(new Locale("en"));
//        Random random = new Random();
//        for (int i = 0; i < 20; i++) {
//            Name name = faker.name();
//            String username = name.username().replace(".", "");
//            str += String.format(
//                    "INSERT INTO `points`.`users` (`username`, `password`, `first_name`, `last_name`, `email`, `phone`, `note`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s');\n",
//                    username, passwordEncoder.encode(username), name.firstName(), name.lastName(), username+"@example.com", faker.phoneNumber().phoneNumber(), faker.lorem().characters(5, 50, true)
//            );
//
//        }
//        return str;
//    }

}
