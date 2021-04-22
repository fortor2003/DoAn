package pl.banhangtichluy.config;

import com.querydsl.jpa.impl.JPAQueryFactory;
import lombok.RequiredArgsConstructor;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.context.annotation.PropertySource;

import javax.persistence.EntityManager;
import java.text.SimpleDateFormat;

@Configuration
@RequiredArgsConstructor
public class BeanConfig {

    @Value("${app.format.date}")
    private String formatDate;
    private final EntityManager entityManager;

    @Bean
    public JPAQueryFactory jpaQueryFactory() {
        return new JPAQueryFactory(entityManager);
    }

    @Bean
    public SimpleDateFormat simpleDateFormat() {
        return new SimpleDateFormat(formatDate);
    }

}
