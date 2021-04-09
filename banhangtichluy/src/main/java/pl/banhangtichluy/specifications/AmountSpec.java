package pl.banhangtichluy.specifications;

import org.springframework.data.jpa.domain.Specification;
import pl.banhangtichluy.entity.Amount;
import pl.banhangtichluy.entity.Amount_;
import pl.banhangtichluy.enums.AmountType;

public final class AmountSpec {

    public static final Specification<Amount> hasTypeEqual(AmountType type) {
        if (type == null)
            return null;
        return (root, query, criteriaBuilder) -> {
            return criteriaBuilder.equal(root.get(Amount_.TYPE), type);
        };
    }

    public static final Specification<Amount> hasCodeContain(String code) {
        if (code == null)
            return null;
        return (root, query, criteriaBuilder) -> criteriaBuilder.like(root.get(Amount_.CODE), "%" + code + "%");
    }

    public static final Specification<Amount> hasValueEqual(Integer value) {
        if (value == null)
            return null;
        return (root, query, criteriaBuilder) -> criteriaBuilder.equal(root.get(Amount_.VALUE), value);
    }

    public static final Specification<Amount> hasFirstNameContain(String firstName) {
        if (firstName == null)
            return null;
        return (root, query, criteriaBuilder) -> criteriaBuilder.like(root.get(Amount_.FIRST_NAME), "%" + firstName + "%");
    }

    public static final Specification<Amount> hasLastNameContain(String lastName) {
        if (lastName == null)
            return null;
        return (root, query, criteriaBuilder) -> criteriaBuilder.like(root.get(Amount_.LAST_NAME), "%" + lastName + "%");
    }

    public static final Specification<Amount> hasEmailContain(String email) {
        if (email == null)
            return null;
        return (root, query, criteriaBuilder) -> criteriaBuilder.like(root.get(Amount_.EMAIL), "%" + email + "%");
    }

    public static final Specification<Amount> hasPhoneContain(String phone) {
        if (phone == null)
            return null;
        return (root, query, criteriaBuilder) -> criteriaBuilder.like(root.get(Amount_.PHONE), "%" + phone + "%");
    }

    public static final Specification<Amount> hasNoteContain(String note) {
        if (note == null)
            return null;
        return (root, query, criteriaBuilder) -> criteriaBuilder.like(root.get(Amount_.NOTE), "%" + note + "%");
    }

}
