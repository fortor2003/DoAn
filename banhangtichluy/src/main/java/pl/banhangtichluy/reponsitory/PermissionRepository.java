package pl.banhangtichluy.reponsitory;

import org.springframework.data.jpa.repository.JpaRepository;
import pl.banhangtichluy.entity.Permission;

import java.util.List;
import java.util.Optional;

public interface PermissionRepository extends JpaRepository<Permission, Long> {

    <T> List<T> findBy(Class<T> type);

    <T> Optional<T> findById(Long id, Class<T> clazz);
    <T> Optional<T> findByName(String name, Class<T> clazz);

}
