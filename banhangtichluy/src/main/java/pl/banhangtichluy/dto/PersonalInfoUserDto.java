package pl.banhangtichluy.dto;

import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.databind.annotation.JsonDeserialize;
import lombok.Data;
import pl.banhangtichluy.deserializers.WhiteSpaceRemovalDeserializer;

import javax.validation.constraints.Email;
import javax.validation.constraints.NotBlank;
import javax.validation.constraints.Pattern;
import javax.validation.constraints.Size;

@Data
public class PersonalInfoUserDto {

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
