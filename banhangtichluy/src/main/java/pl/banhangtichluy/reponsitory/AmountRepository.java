package pl.banhangtichluy.reponsitory;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import pl.banhangtichluy.entity.Amount;

public interface AmountRepository extends JpaRepository<Amount, Long> {

    Page<Amount> findByTypeContaining(String type, Pageable pageable);
    Page<Amount> findByCodeContaining(String code, Pageable pageable);
    Page<Amount> findByValue(Integer value, Pageable pageable);
    Page<Amount> findByFirstNameContaining(String firstName, Pageable pageable);
    Page<Amount> findByLastNameContaining(String lastName, Pageable pageable);
    Page<Amount> findByEmailContaining(String email, Pageable pageable);
    Page<Amount> findByPhoneContaining(String phone, Pageable pageable);
    Page<Amount> findByNoteContaining(String node, Pageable pageable);

}
