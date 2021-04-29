package pl.banhangtichluy;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.data.jpa.repository.config.EnableJpaRepositories;
import pl.banhangtichluy.querydsl.QuerydslJpaRepositoryFactoryBean;

@EnableJpaRepositories(repositoryFactoryBeanClass = QuerydslJpaRepositoryFactoryBean.class)
@SpringBootApplication
public class Application {

    public static void main(String[] args) {
        SpringApplication.run(Application.class, args);
    }
}
