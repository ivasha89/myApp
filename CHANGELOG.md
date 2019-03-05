# Release Notes

## [v5.8.0 (2019-02-26)](https://github.com/laravel/laravel/compare/v5.7.28...v5.8.0)

### Added
- Added DynamoDB configuration ([1be5e29](https://github.com/laravel/laravel/commit/1be5e29753d3592d0305db17d0bffcf312ef5625))
- Add env variable for mysql ssl cert ([9180f64](https://github.com/laravel/laravel/commit/9180f646d3a99e22d2d2a957df6ed7b550214b2f))
- Add beanstalk queue block_for config key ([#4913](https://github.com/laravel/laravel/pull/4913))
- Add `hash` config param to api auth driver ([d201c69](https://github.com/laravel/laravel/commit/d201c69a8bb6cf7407ac3a6c0a0e89f183061682))
- Add postmark token ([4574265](https://github.com/laravel/laravel/commit/45742652ccb0de5e569c23ec826f6106a8550432))
- Add `Arr` and `Str` aliases by default ([#4951](https://github.com/laravel/laravel/pull/4951))

### Changed
- Change password min length to 8 ([#4794](https://github.com/laravel/laravel/pull/4794)) 
- Update UserFactory password ([#4797](https://github.com/laravel/laravel/pull/4797))
- Update AWS env variables ([87667b2](https://github.com/laravel/laravel/commit/87667b25ae57308f8bbc47f45222d2d1de3ffeed))
- Update minimum PHPUnit version to 7.5 ([7546842](https://github.com/laravel/laravel/commit/75468420a4c6c28b980319240056e884b4647d63))
- Replace string helper ([fae44ee](https://github.com/laravel/laravel/commit/fae44eeb26d549a695a1ea0267b117adf55f83e8))
- Use `$_SERVER` instead of `$_ENV` for PHPUnit ([#4943](https://github.com/laravel/laravel/pull/4943))
- Add `REDIS_CLIENT` env variable ([ea7fc0b](https://github.com/laravel/laravel/commit/ea7fc0b3361a3d3dc2cb9f83f030669bbcb31e1d))
- Use bigIncrements by default ([#4946](https://github.com/laravel/laravel/pull/4946))

### Fixed
- Fix unterminated statements ([#4952](https://github.com/laravel/laravel/pull/4952))

### Removed
- Removed error svgs ([cfc2220](https://github.com/laravel/laravel/commit/cfc2220109dd0813ad5d19702b58b3b1a0a2222e))


## [v5.7.28 (2019-02-05)](https://github.com/laravel/laravel/compare/v5.7.19...v5.7.28)

### Added
- Hint for lenient log stacks ([#4918](https://github.com/laravel/laravel/pull/4918))
- Attribute casting for `email_verified_at` on `User` model stub ([#4930](https://github.com/laravel/laravel/pull/4930))

### Changed
- Remove unused Bootstrap class ([#4917](https://github.com/laravel/laravel/pull/4917))
- Change order of boot and register methods in service providers ([#4921](https://github.com/laravel/laravel/pull/4921))
- `web.config` comment to help debug issues ([#4924](https://github.com/laravel/laravel/pull/4924))
- Use `Str::random()` instead of `str_random()` ([#4926](https://github.com/laravel/laravel/pull/4926))
- Remove unnecessary link type on "welcome" view ([#4935](https://github.com/laravel/laravel/pull/4935))