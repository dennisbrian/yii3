# 📚 Atlas' Journal - Critical Learnings

## 2026-01-16 - Auth vs Domain Separation
**Discovery:** The codebase strictly separates User Identity (Authentication) from User Entity (Domain).
**Implication:**
- `App\User\Identity` (in `src/User/`) implements `IdentityInterface` and is used for session/auth checks.
- `App\Entity\User` (in `src/Entity/`) is the domain model representing the business entity.
- `App\User\IdentityRepository` handles persistence for auth, but there might be a separate repository for domain logic (though not seen yet, `IdentityRepository` seems to handle creation too).
**Documentation Action:** This distinction must be highlighted in `COMPONENTS.md` and `ARCHITECTURE.md` to prevent confusion for new developers accustomed to ActiveRecord where one class does it all.
