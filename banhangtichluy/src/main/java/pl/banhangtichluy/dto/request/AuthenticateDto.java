package pl.banhangtichluy.dto.request;

import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

import javax.validation.constraints.NotBlank;
import javax.validation.constraints.Size;

@Data
public class AuthenticateDto {

    @NotBlank(message = "username is required")
    @JsonProperty("username")
    private String username;

    @NotBlank(message = "password is required")
    @JsonProperty("password")
    private String password;

}
