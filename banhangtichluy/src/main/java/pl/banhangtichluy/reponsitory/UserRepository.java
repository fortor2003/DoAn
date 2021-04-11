package pl.banhangtichluy.reponsitory;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import pl.banhangtichluy.entity.User;

import java.util.List;
import java.util.Optional;

public interface UserRepository extends JpaRepository<User, Long> {

    <T> Page<T> findBy(Class<T> type, Pageable pageable);
    <T> Page<T> findByUsernameContaining(String username, Class<T> clazz, Pageable pageable);
    <T> Page<T> findByFirstNameContaining(String firstName, Class<T> clazz, Pageable pageable);
    <T> Page<T> findByLastNameContaining(String lastName, Class<T> clazz, Pageable pageable);
    <T> Page<T> findByEmailContaining(String email, Class<T> clazz, Pageable pageable);
    <T> Page<T> findByPhoneContaining(String phone, Class<T> clazz, Pageable pageable);
    <T> Page<T> findByNoteContaining(String note, Class<T> clazz, Pageable pageable);

    <T> Optional<T> findById(Long id, Class<T> clazz);
    <T> Optional<T> findByUsername(String username, Class<T> clazz);

    @Query("select distinct r.name from User u left join u.userRoles ur left join ur.role r where u.id = ?1")
    List<String> roleNamesById(Long id);
    @Query("select distinct r.name from User u left join u.userRoles ur left join ur.role r where u.username = ?1")
    List<String> roleNamesByUsername(String username);

    @Query("select distinct p.name from User u left join u.userRoles ur left join ur.role r left join r.rolePermissions rp left join rp.permission p where u.id = ?1")
    List<String> permissionNamesById(Long id);
    @Query("select distinct p.name from User u left join u.userRoles ur left join ur.role r left join r.rolePermissions rp left join rp.permission p where u.username = ?1")
    List<String> permissionNamesByUsername(String username);

    @Query("select count(u) from User u where u.username = ?1")
    int countByUsername(String username);
    @Query("select count(u) from User u where u.username = ?1 and u.id <> ?2")
    int countByUsernameExceptId(String username, Long id);

}
