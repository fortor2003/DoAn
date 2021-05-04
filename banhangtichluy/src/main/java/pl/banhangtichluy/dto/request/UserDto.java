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
public class UserDto {

    @NotBlank(message = "username is required")
    @Size(min = 4, max = 20, message = "length of username must be greater or equal 4 and less than or equal 20")
    @Pattern(regexp = "^[A-Za-z]+([A-Za-z0-9_])+$", message = "username only contain [A-Za-z0-9_] and start with a letter")
    @JsonProperty("username")
    @JsonDeserialize(using = WhiteSpaceRemovalDeserializer.class)
    private String username;

    @NotBlank(message = "password is required")
    @Size(min = 6, max = 30, message = "length of password must be greater or equal 8 and less than or equal 20")
    @JsonProperty("password")
    private String password;

    @NotBlank(message = "firstName is required")
    @JsonProperty("firstName")
    @JsonDeserialize(using = WhiteSpaceRemovalDeserializer.class)
    private String firstName;

    @NotBlank(message = "lastName is required")
    @JsonProperty("lastName")
    @JsonDeserialize(using = WhiteSpaceRemovalDeserializer.class)
    private String lastName;

    @Email(message = "email should be valid")
    @JsonProperty("email")
    @JsonDeserialize(using = WhiteSpaceRemovalDeserializer.class)
    private String email;

    @JsonProperty("phone")
    @JsonDeserialize(using = WhiteSpaceRemovalDeserializer.class)
    private String phone;

    @JsonProperty("note")
    @JsonDeserialize(using = WhiteSpaceRemovalDeserializer.class)
    private String note;

}
