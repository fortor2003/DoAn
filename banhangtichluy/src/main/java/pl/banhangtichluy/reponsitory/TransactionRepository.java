package pl.banhangtichluy.reponsitory;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.JpaSpecificationExecutor;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import pl.banhangtichluy.dto.views.TransactionView;
import pl.banhangtichluy.entity.Amount;
import pl.banhangtichluy.entity.Transaction;

import java.util.List;
import java.util.Optional;

public interface TransactionRepository extends JpaRepository<Transaction, Long> {

    <T> Page<T> findBy(Class<T> type, Pageable pageable);
    <T> Page<T> findByCodeContaining(String code, Class<T> clazz, Pageable pageable);
    <T> Page<T> findByBeforeValueEquals(Integer beforeValue, Class<T> clazz, Pageable pageable);
    <T> Page<T> findByPlusValueEquals(Integer plusValue, Class<T> clazz, Pageable pageable);
    <T> Page<T> findByAfterValueEquals(Integer afterValue, Class<T> clazz, Pageable pageable);
    <T> Page<T> findByNoteContaining(String note, Class<T> clazz, Pageable pageable);
    @Query(
            value = "select t,a,cb,ub from Transaction t left join t.amount a left join t.createdBy cb left join t.updatedBy ub where a.type = :type",
            countQuery = "select count(t) from Transaction t left join t.amount a left join t.createdBy cb left join t.updatedBy ub where a.type = :type"
    )
    <T> Page<T> findByAmount_Type(@Param("type") String type, Class<T> clazz, Pageable pageable);

    @Query(
            value = "select t,a,cb,ub from Transaction t left join t.amount a left join t.createdBy cb left join t.updatedBy ub where a.type = :type"
    )
    Page<TransactionView> findByAmount_Type2(@Param("type") String type, Pageable pageable);

    <T> Optional<T> findById(Long id, Class<T> clazz);
    <T> Optional<T> findByCodeEquals(String code, Class<T> clazz);

    @Query("select count(t) from Transaction t where t.code = ?1")
    int countByCode(String type, String code);
    @Query("select count(t) from Transaction t where t.code = ?1 and t.id <> ?2")
    int countByCodeExceptId(String code, Long id);


}
