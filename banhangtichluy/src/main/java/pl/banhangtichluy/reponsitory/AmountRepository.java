package pl.banhangtichluy.reponsitory;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.domain.Specification;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.JpaSpecificationExecutor;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.querydsl.QuerydslPredicateExecutor;
import pl.banhangtichluy.dto.views.AmountView;
import pl.banhangtichluy.entity.Amount;
import pl.banhangtichluy.querydsl.ExtendedQuerydslPredicateExecutor;

import java.util.List;
import java.util.Optional;

public interface AmountRepository extends JpaRepository<Amount, Long>, ExtendedQuerydslPredicateExecutor<Amount> {

    <T> Page<T> findBy(Class<T> type, Pageable pageable);
    <T> Page<T> findByTypeEquals(String type, Class<T> clazz, Pageable pageable);
    <T> Page<T> findByCodeContaining(String code, Class<T> clazz, Pageable pageable);
    <T> Page<T> findByValueEquals(Integer value, Class<T> clazz, Pageable pageable);
    <T> Page<T> findByFirstNameContaining(String firstName, Class<T> clazz, Pageable pageable);
    <T> Page<T> findByLastNameContaining(String lastName, Class<T> clazz, Pageable pageable);
    <T> Page<T> findByEmailContaining(String email, Class<T> clazz, Pageable pageable);
    <T> Page<T> findByPhoneContaining(String phone, Class<T> clazz, Pageable pageable);
    <T> Page<T> findByNoteContaining(String note, Class<T> clazz, Pageable pageable);

    <T> Optional<T> findById(Long id, Class<T> clazz);
    <T> Optional<T> findByTypeEqualsAndCodeEquals(String type, String code, Class<T> clazz);

    @Query("select count(a) from Amount a where a.type = ?1 and a.code = ?2")
    int countByTypeAndCode(String type, String code);
    @Query("select count(a) from Amount a where a.type = ?1 and a.code = ?2 and a.id <> ?3")
    int countByTypeAndCodeExceptId(String type, String code, Long id);
}
