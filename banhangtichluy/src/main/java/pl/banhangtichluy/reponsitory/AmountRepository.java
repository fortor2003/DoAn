package pl.banhangtichluy.reponsitory;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import pl.banhangtichluy.entity.Amount;
import pl.banhangtichluy.querydsl.ExtendedQuerydslPredicateExecutor;

public interface AmountRepository extends JpaRepository<Amount, Long>, ExtendedQuerydslPredicateExecutor<Amount> {

    @Query("select count(a) from Amount a where a.type = ?1 and a.code = ?2")
    int countByTypeAndCode(String type, String code);
    @Query("select count(a) from Amount a where a.type = ?1 and a.code = ?2 and a.id <> ?3")
    int countByTypeAndCodeExceptId(String type, String code, Long id);
}
