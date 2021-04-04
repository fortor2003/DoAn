package pl.banhangtichluy.reponsitory;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;
import pl.banhangtichluy.entity.The;

import java.util.List;

@Repository
public interface IThe extends JpaRepository<The, Integer> {

    The findByMaSo(String ms);
    The findById(Long id);

}
