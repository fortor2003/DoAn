package pl.banhangtichluy.config;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.authentication.AuthenticationManager;
import org.springframework.security.config.annotation.authentication.builders.AuthenticationManagerBuilder;
import org.springframework.security.config.annotation.method.configuration.EnableGlobalMethodSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.config.annotation.web.configuration.WebSecurityConfigurerAdapter;
import org.springframework.security.core.authority.SimpleGrantedAuthority;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import pl.banhangtichluy.service.PermissionService;
import pl.banhangtichluy.service.UserDetailsServiceImpl;

import java.util.List;
import java.util.stream.Collectors;

@Configuration
@EnableWebSecurity
@EnableGlobalMethodSecurity(prePostEnabled = true)
public class SecurityConfigurer extends WebSecurityConfigurerAdapter {

    @Value("${spring.profiles.active}")
    private String activeProfile;
    @Autowired
    private UserDetailsServiceImpl userDetailsService;
    @Autowired
    private PermissionService permissionService;

    @Override
    protected void configure(AuthenticationManagerBuilder auth) throws Exception {
        List<SimpleGrantedAuthority> authorities = permissionService.getAllPermissionNames().stream().map(pn -> new SimpleGrantedAuthority(pn)).collect(Collectors.toList());
        if (activeProfile.equals("dev")) {
            auth.inMemoryAuthentication()
                    .withUser("nhtlong").password(passwordEncoder().encode("nhtlong")).authorities(authorities)
                    .and()
                    .withUser("lploi").password(passwordEncoder().encode("lploi")).authorities(authorities)
            ;
        }
        auth.userDetailsService(userDetailsService).passwordEncoder(passwordEncoder());
    }

    @Override
    @Bean
    public AuthenticationManager authenticationManagerBean() throws Exception {
        return super.authenticationManagerBean();
    }

    @Bean
    public PasswordEncoder passwordEncoder() {
        return new BCryptPasswordEncoder();
    }
}
