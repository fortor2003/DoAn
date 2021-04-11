package pl.banhangtichluy;

import io.jsonwebtoken.SignatureAlgorithm;
import io.jsonwebtoken.io.Encoders;
import io.jsonwebtoken.security.Keys;
import pl.banhangtichluy.entity.Amount_;
import pl.banhangtichluy.utils.ClassUtils;

import javax.crypto.SecretKey;
import javax.persistence.metamodel.SingularAttribute;
import java.text.DecimalFormat;
import java.util.List;
import java.util.UUID;

public class MainTest {
    public static void main(String[] args) {
        SecretKey key = Keys.secretKeyFor(SignatureAlgorithm.HS256);
        String base64 = Encoders.BASE64.encode(key.getEncoded());
        String base64url = Encoders.BASE64URL.encode(key.getEncoded());
        System.out.println(base64);
    }
}
