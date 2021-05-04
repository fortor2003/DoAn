package pl.banhangtichluy.controller.api.manager;

import io.swagger.annotations.Api;
import io.swagger.annotations.ApiOperation;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.authentication.AuthenticationManager;
import org.springframework.security.authentication.BadCredentialsException;
import org.springframework.security.authentication.UsernamePasswordAuthenticationToken;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.server.ResponseStatusException;
import pl.banhangtichluy.dto.request.AuthenticateDto;
import pl.banhangtichluy.dto.views.PersonalInfoView;
import pl.banhangtichluy.dto.views.UserView;
import pl.banhangtichluy.service.JwtService;
import pl.banhangtichluy.service.RoleService;
import pl.banhangtichluy.service.UserDetailsServiceImpl;
import pl.banhangtichluy.service.UserService;

import javax.validation.Valid;
import java.util.List;
import java.util.stream.Collectors;

@RestController
@RequestMapping("${spring.data.rest.base-path.manager}/auth")
@Api(tags = "Authentication", description = "Authentication API")
@ApiOperation(value = "${spring.data.rest.base-path.manager}/auth", tags = "Authentication")
public class AuthenticationController {

    @Autowired
    RoleService roleService;
    @Autowired
    UserService userService;
    @Autowired
    AuthenticationManager authenticationManager;
    @Autowired
    UserDetailsServiceImpl userDetailsService;
    @Autowired
    JwtService jwtService;

    @PostMapping("/login")
    @ApiOperation(value = "Login to get the token api")
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

    @PostMapping("/my-info")
    @ApiOperation(value = "Get my personal info")
    public PersonalInfoView myInfo(Authentication auth) {
        UserView userView = userService.detailByUsername(auth.getName()).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Username does not exist"));
        List<String> authorities = auth.getAuthorities().stream().map(a -> a.getAuthority()).collect(Collectors.toList());
        return PersonalInfoView.builder()
                .id(userView.getId())
                .username(userView.getUsername())
                .firstName(userView.getFirstName())
                .lastName(userView.getLastName())
                .authorities(authorities)
                .build();
    }

}
