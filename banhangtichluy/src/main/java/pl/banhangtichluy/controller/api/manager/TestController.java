package pl.banhangtichluy.controller.api.manager;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.web.bind.annotation.*;
import pl.banhangtichluy.reponsitory.AmountRepository;
import pl.banhangtichluy.reponsitory.TransactionRepository;
import pl.banhangtichluy.reponsitory.UserRepository;
import pl.banhangtichluy.service.JwtService;
import pl.banhangtichluy.service.UserService;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

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
//
//    @GetMapping("transactions")
//    public Page<TransactionView> listTransaction() {
//        return transactionRepository.findByAmount_Type("POINT", TransactionView.class, PageRequest.of(0,50));
//    }
//
//    @GetMapping("transactions2")
//    public Page<TransactionView> listTransaction2() {
//        return transactionRepository.findByAmount_Type2("POINT", PageRequest.of(0,10));
//    }

}
