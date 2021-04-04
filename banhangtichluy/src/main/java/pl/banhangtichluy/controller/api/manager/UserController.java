package pl.banhangtichluy.controller.api.manager;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.dto.UserDto;
import pl.banhangtichluy.entity.User;
import pl.banhangtichluy.reponsitory.UserRepository;

import javax.validation.Valid;
import java.util.List;

@RestController
@RequestMapping("${spring.data.rest.base-path.manager}/users")
public class UserController {

    @Autowired
    UserRepository userRepository;

    @GetMapping("")
    public List<User> findAll() {
        return userRepository.findAll();
    }

    @GetMapping("/{id}")
    public User findById(@PathVariable("id") Long id) throws Exception {
        return userRepository.findById(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "ID User not found"));
    }

    @PostMapping("")
    public User createUser(@Valid @RequestBody UserDto userDto) {
        return new User();
    }
}
