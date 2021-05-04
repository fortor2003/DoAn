package pl.banhangtichluy.dto.request;

import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.databind.annotation.JsonDeserialize;
import lombok.Data;
import pl.banhangtichluy.deserializers.WhiteSpaceRemovalDeserializer;

import javax.validation.constraints.Email;
import javax.validation.constraints.NotBlank;
import javax.validation.constraints.Pattern;
import javax.validation.constraints.Size;

@Data
public class PasswordUserDto {

    @NotBlank(message = "password is required")
    @Size(min = 6, max = 30, message = "length of password must be greater or equal 8 and less than or equal 20")
    @JsonProperty("password")
    private String password;

}
