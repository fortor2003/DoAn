package pl.banhangtichluy.controller.api.manager;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.authentication.AuthenticationManager;
import org.springframework.security.authentication.BadCredentialsException;
import org.springframework.security.authentication.UsernamePasswordAuthenticationToken;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.dto.AuthenticateDto;
import pl.banhangtichluy.dto.views.RoleView;
import pl.banhangtichluy.service.JwtService;
import pl.banhangtichluy.service.RoleService;
import pl.banhangtichluy.service.UserDetailsServiceImpl;

import javax.validation.Valid;
import java.util.List;

@RestController
@RequestMapping("${spring.data.rest.base-path.manager}/auth")
public class AuthenticationController {

    @Autowired
    RoleService roleService;
    @Autowired
    AuthenticationManager authenticationManager;
    @Autowired
    UserDetailsServiceImpl userDetailsService;
    @Autowired
    JwtService jwtService;

    @GetMapping("")
    public List<RoleView> list() {
        return roleService.list();
    }

    @PostMapping("/login")
    public ResponseEntity<?> detail(@Valid @RequestBody AuthenticateDto dto) {
        try {
            authenticationManager.authenticate(new UsernamePasswordAuthenticationToken(dto.getUsername(), dto.getPassword()));
        } catch (BadCredentialsException ex) {
            throw new ResponseStatusException(HttpStatus.UNAUTHORIZED, "Inccorect username or password");
        }
        final UserDetails userDetails = userDetailsService.loadUserByUsername(dto.getUsername());
        final String token = jwtService.generateToken(userDetails);
        return ResponseEntity.ok(token);
    }
}
