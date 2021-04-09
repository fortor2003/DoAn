package pl.banhangtichluy;

import pl.banhangtichluy.entity.Amount_;
import pl.banhangtichluy.utils.ClassUtils;

import javax.persistence.metamodel.SingularAttribute;
import java.text.DecimalFormat;
import java.util.List;
import java.util.UUID;

public class MainTest {
    public static void main(String[] args) {
        DecimalFormat myFormatter = new DecimalFormat("TRS0000000000");
        System.out.println(myFormatter.format(251));
//        System.out.println(UUID.randomUUID().toString().replace("-", "").toUpperCase());
    }
}
