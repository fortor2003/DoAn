package pl.banhangtichluy.reponsitory;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;
import pl.banhangtichluy.entity.Diem;

@Repository
public interface IDiem extends JpaRepository<Diem, Integer> {
    Diem findByLoaiThe(Long LoaiThe); //1 Point - 2 Gift
}
