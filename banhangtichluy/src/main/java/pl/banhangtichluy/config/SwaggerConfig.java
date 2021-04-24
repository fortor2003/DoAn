package pl.banhangtichluy.config;

import com.fasterxml.classmate.TypeResolver;
import com.google.common.base.Predicate;
import com.google.common.base.Predicates;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.context.annotation.Import;
import org.springframework.http.HttpStatus;
import org.springframework.validation.ObjectError;
import org.springframework.web.bind.annotation.RequestMethod;
import pl.banhangtichluy.dto.AmountDto;
import pl.banhangtichluy.dto.response.FormErrorDto;
import springfox.documentation.builders.ApiInfoBuilder;
import springfox.documentation.builders.PathSelectors;
import springfox.documentation.builders.RequestHandlerSelectors;
import springfox.documentation.builders.ResponseMessageBuilder;
import springfox.documentation.schema.AlternateTypeRule;
import springfox.documentation.schema.AlternateTypeRules;
import springfox.documentation.schema.ModelRef;
import springfox.documentation.schema.WildcardType;
import springfox.documentation.service.ApiInfo;
import springfox.documentation.service.ResponseMessage;
import springfox.documentation.spi.DocumentationType;
import springfox.documentation.spring.web.plugins.Docket;
import springfox.documentation.swagger2.annotations.EnableSwagger2;

import java.util.Arrays;
import java.util.Collection;
import java.util.List;

@Configuration
@EnableSwagger2
public class SwaggerConfig {

    @Value("${spring.data.rest.base-path.manager}")
    private String basePath;

    @Autowired
    private TypeResolver resolver;

    @Bean
    public Docket docket() {
        return new Docket(DocumentationType.SWAGGER_2)
                .apiInfo(apiInfo())
                .useDefaultResponseMessages(false)
                .globalResponseMessage(RequestMethod.GET, responseMessages())
                .globalResponseMessage(RequestMethod.POST, responseMessages())
                .globalResponseMessage(RequestMethod.PUT, responseMessages())
                .globalResponseMessage(RequestMethod.PATCH, responseMessages())
                .globalResponseMessage(RequestMethod.DELETE, responseMessages())
//                .additionalModels(resolver.resolve(FormErrorDto.class))
                .select().paths(paths())
                .build();
    }

    private ApiInfo apiInfo() {
        return new ApiInfoBuilder()
                .title("Application Manage Point API")
                .description("This API used to manage point")
                .version("V1.0")
                .build();
    }

    private Predicate<String> paths() {
        return Predicates.or(
                PathSelectors.regex(basePath + "/amounts(/*|/*.*)$"),
                PathSelectors.regex(basePath + "/transaction(/*|/*.*)$")
        );
    }

    private List<ResponseMessage> responseMessages() {

        return Arrays.asList(
                new ResponseMessageBuilder().code(HttpStatus.OK.value()).message(HttpStatus.OK.getReasonPhrase()).build(),
                new ResponseMessageBuilder().code(HttpStatus.BAD_REQUEST.value()).message(HttpStatus.BAD_REQUEST.getReasonPhrase()).responseModel(new ModelRef(FormErrorDto.class.getSimpleName())).build(),
                new ResponseMessageBuilder().code(HttpStatus.UNAUTHORIZED.value()).message(HttpStatus.UNAUTHORIZED.getReasonPhrase()).build(),
                new ResponseMessageBuilder().code(HttpStatus.FORBIDDEN.value()).message(HttpStatus.FORBIDDEN.getReasonPhrase()).build(),
                new ResponseMessageBuilder().code(HttpStatus.NOT_FOUND.value()).message(HttpStatus.NOT_FOUND.getReasonPhrase()).build(),
                new ResponseMessageBuilder().code(HttpStatus.INTERNAL_SERVER_ERROR.value()).message(HttpStatus.INTERNAL_SERVER_ERROR.getReasonPhrase()).build()
        );
    }

}
