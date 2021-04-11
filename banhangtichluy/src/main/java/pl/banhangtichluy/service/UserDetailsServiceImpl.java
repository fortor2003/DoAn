package pl.banhangtichluy.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.security.core.userdetails.UserDetailsService;
import org.springframework.security.core.userdetails.UsernameNotFoundException;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;
import pl.banhangtichluy.entity.User;
import pl.banhangtichluy.model.UserDetailsImpl;
import pl.banhangtichluy.reponsitory.UserRepository;

@Service
@Transactional
public class UserDetailsServiceImpl implements UserDetailsService {

    @Autowired
    UserRepository userRepository;

    @Override
    public UserDetails loadUserByUsername(String username) throws UsernameNotFoundException {
        User user = userRepository.findByUsername(username, User.class).orElseThrow(() -> new UsernameNotFoundException("Username not exist"));
        return new UserDetailsImpl(user);
    }
}
