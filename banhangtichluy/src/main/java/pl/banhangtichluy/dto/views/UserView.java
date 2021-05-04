package pl.banhangtichluy.dto.views;

import com.querydsl.core.Tuple;
import com.querydsl.core.types.MappingProjection;
import io.swagger.annotations.ApiModel;
import io.swagger.annotations.ApiModelProperty;
import lombok.Data;
import lombok.EqualsAndHashCode;
import lombok.NoArgsConstructor;
import lombok.experimental.SuperBuilder;
import pl.banhangtichluy.constants.EntityPropsDescriptionConstant;
import pl.banhangtichluy.entity.QUser;

import java.util.Date;

@Data
@SuperBuilder
@NoArgsConstructor
@EqualsAndHashCode(callSuper = true)
@ApiModel(value = "UserView", description = "Detailed information of user")
public class UserView extends UserBaseView {

    @ApiModelProperty(name = "email", notes = EntityPropsDescriptionConstant.UserProps.EMAIL, example = "dustyemmerich@example.com")
    private String email;

    @ApiModelProperty(name = "phone", notes = EntityPropsDescriptionConstant.UserProps.PHONE, example = "(431) 000-5334")
    private String phone;

    @ApiModelProperty(name = "note", notes = EntityPropsDescriptionConstant.UserProps.NOTE, example = "Example note")
    private String note;

    @ApiModelProperty(name = "createdAt", notes = EntityPropsDescriptionConstant.UserProps.CREATED_AT, example = "2020-08-13 14:30:00")
    private Date createdAt;

    @ApiModelProperty(name = "updatedAt", notes = EntityPropsDescriptionConstant.UserProps.UPDATED_AT, example = "2020-10-20 08:10:50")
    private Date updatedAt;

    private static final QUser user = QUser.user;

    public static final MappingProjection<UserView> PROJECTIONS = new MappingProjection<UserView>(
            UserView.class,
            user.id, user.username, user.firstName, user.lastName, user.email, user.phone, user.note, user.createdAt, user.updatedAt
    ) {
        @Override
        protected UserView map(Tuple row) {
            return UserView.builder()
                    .id(row.get(user.id))
                    .username(row.get(user.username))
                    .firstName(row.get(user.firstName))
                    .lastName(row.get(user.lastName))
                    .email(row.get(user.email))
                    .phone(row.get(user.phone))
                    .note(row.get(user.note))
                    .createdAt(row.get(user.createdAt))
                    .updatedAt(row.get(user.updatedAt))
                    .build();
        }
    };
}
