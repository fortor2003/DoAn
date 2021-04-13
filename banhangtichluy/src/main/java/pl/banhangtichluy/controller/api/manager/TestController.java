package pl.banhangtichluy.controller.api.manager;

import com.github.javafaker.Faker;
import com.github.javafaker.Name;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.http.HttpStatus;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.dto.PasswordUserDto;
import pl.banhangtichluy.dto.PersonalInfoUserDto;
import pl.banhangtichluy.dto.UserDto;
import pl.banhangtichluy.dto.criteria.BaseCriteriaDto;
import pl.banhangtichluy.dto.views.TransactionView;
import pl.banhangtichluy.dto.views.UserView;
import pl.banhangtichluy.entity.User;
import pl.banhangtichluy.reponsitory.AmountRepository;
import pl.banhangtichluy.reponsitory.TransactionRepository;
import pl.banhangtichluy.reponsitory.UserRepository;
import pl.banhangtichluy.service.JwtService;
import pl.banhangtichluy.service.TransactionService;
import pl.banhangtichluy.service.UserService;

import javax.validation.Valid;
import java.util.*;

@RestController
@RequestMapping("${spring.data.rest.base-path.manager}/tests")
public class TestController {

    @Autowired
    UserRepository userRepository;
    @Autowired
    UserService userService;
    @Autowired
    PasswordEncoder passwordEncoder;
    @Autowired
    JwtService jwtService;
    @Autowired
    AmountRepository amountRepository;
    @Autowired
    TransactionRepository transactionRepository;

    @GetMapping("user/{id}")
    public List<String> permissionNames(@PathVariable("id") String id) throws Exception {
        return userRepository.permissionNamesByUsername(id);
    }

//    @GetMapping("/change-pass")
//    public String changePass() throws Exception {
//        User user = userRepository.findById(1L).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND));
//        user.setPassword(passwordEncoder.encode("howardrolfson"));
//        return "OK";
//    }

    @GetMapping("/encode-pass/{pass}")
    public String encodePass(@PathVariable("pass") String pass) throws Exception {
        return passwordEncoder.encode(pass);
    }

    @GetMapping("gen-token/{username}")
    public String genToken(@PathVariable("username") String username) throws Exception {
        Map<String, Object> map = new HashMap<>();
        map.put("key1", "value1");
        return jwtService.createToken(map, username);
    }

    @GetMapping("extract-token/{token}")
    public String extractJws(
            @PathVariable("token") String token,
            @RequestParam(name = "part", required = false, defaultValue = "username") String part
    ) {
        if (part.equals("expiration")) {
            return jwtService.extractExpiration(token).toString();
        }
        return jwtService.extractUsername(token);
    }

    @GetMapping("transactions")
    public Page<TransactionView> listTransaction() {
        return transactionRepository.findByAmount_Type("POINT", TransactionView.class, PageRequest.of(0,50));
    }

    @GetMapping("transactions2")
    public Page<TransactionView> listTransaction2() {
        return transactionRepository.findByAmount_Type2("POINT", PageRequest.of(0,10));
    }
}
