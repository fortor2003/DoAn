package pl.banhangtichluy.dto.views.v2;

import com.querydsl.core.annotations.QueryProjection;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;
import lombok.experimental.SuperBuilder;

@Data
@SuperBuilder
@NoArgsConstructor
public class UserBaseView {

    private Long id;
    private String username;
    private String firstName;
    private String lastName;

}
