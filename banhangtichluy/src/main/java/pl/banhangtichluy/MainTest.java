package pl.banhangtichluy;

import io.jsonwebtoken.io.Decoders;
import io.jsonwebtoken.security.Keys;

import javax.crypto.SecretKey;
import java.text.SimpleDateFormat;
import java.util.Calendar;

public class MainTest {
    public static void main(String[] args) {
        final String SECRET_KEY = "ICbHdXJlLh/oMl0RB/K8UxY1Q/96vO2h46UNLFQmkqw=";
        SecretKey key = Keys.hmacShaKeyFor(Decoders.BASE64.decode(SECRET_KEY));

//        String token = Jwts.builder().setSubject("nhtlong").signWith(key).compact();
//        System.out.println(token);

//        final String token = "eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJuaHRsb25nIn0.w_ogiI2PL0YIi8CfYQaStZOeQzS574j1W3glwAPbc_M";
//        final String token = "eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJuaHRsbyJ9.w_ogiI2PL0YIi8CfYQaStZOeQzS574j1W3glwAPbc_M";
//        try {
//            Jwts.parserBuilder().setSigningKey(key).build().parseClaimsJws(token);
//            System.out.println("Token valid");
//        } catch (JwtException ex) {
//            System.out.println("Token not valid : " + ex.getMessage());
//        }
        SimpleDateFormat formater = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
        Calendar calendar = Calendar.getInstance();
        System.out.println(formater.format(calendar.getTime()));
        calendar.add(Calendar.MINUTE, 10);
        System.out.println(formater.format(calendar.getTime()));
    }
}
